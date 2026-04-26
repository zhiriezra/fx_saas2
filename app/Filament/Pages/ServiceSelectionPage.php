<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\Service;
use App\Models\Unit;
use App\Models\ServiceSetting;
use Illuminate\Support\Facades\Auth;

class ServiceSelectionPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Subscriptions';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.service-selection';

    public ?array $data = [];
    public $services = [];
    public $selectedServices = [];
    public $serviceConfigs = [];
    public $units = [];
    public $totalCost = 0;

    public function mount(): void
    {
        $this->form->fill();
        $this->loadServices();
        $this->loadUnits();
        $this->initializeServiceConfigs();
    }

    protected function loadServices(): void
    {
        $team = Auth::user()->currentTeam;
        if (!$team || !$team->team_type_id) {
            $this->services = collect();
            return;
        }

        $this->services = Service::where('team_type_id', $team->team_type_id)
            ->where('active', true)
            ->get();
    }

    protected function loadUnits(): void
    {
        $this->units = Unit::all();
    }

    protected function initializeServiceConfigs(): void
    {
        foreach ($this->services as $service) {
            $this->serviceConfigs[$service->id] = [
                'quantity' => '',
                'unit_id' => '',
                'duration' => '',
                'selected' => false,
            ];
        }
    }

    public function toggleService($serviceId): void
    {
        $this->serviceConfigs[$serviceId]['selected'] = !$this->serviceConfigs[$serviceId]['selected'];
        $this->calculateTotalCost();
    }

    public function updatedServiceConfigs(): void
    {
        $this->calculateTotalCost();
    }

    protected function calculateTotalCost(): void
    {
        $this->totalCost = 0;
        
        foreach ($this->services as $service) {
            if (!$this->serviceConfigs[$service->id]['selected']) {
                continue;
            }

            $breakdown = $this->getServiceBreakdown($service->id);
            if ($breakdown) {
                $this->totalCost += $breakdown['total'];
            }
        }
    }

    protected function getTotalSizeKg($serviceId): float
    {
        $config = $this->serviceConfigs[$serviceId];
        $quantity = (float) ($config['quantity'] ?? 0);
        $unitId = $config['unit_id'] ?? null;

        if ($quantity <= 0 || !$unitId) {
            return 0;
        }

        $unit = $this->units->firstWhere('id', $unitId);
        $unitName = strtolower(trim($unit->name ?? ''));

        return match ($unitName) {
            'kilogram', 'kilograms', 'kg' => $quantity,
            'tonne', 'tonnes', 'ton', 'tons' => $quantity * 1000,
            'bag', 'bags' => $quantity * (float) ServiceSetting::getSetting($serviceId, 'Average Kg per bag', 0),
            default => $quantity,
        };
    }

    protected function getServiceBreakdown($serviceId): ?array
    {
        $config = $this->serviceConfigs[$serviceId];
        if (!$config['selected'] || !$config['quantity'] || !$config['unit_id'] || !$config['duration']) {
            return null;
        }

        $totalSizeKg = $this->getTotalSizeKg($serviceId);
        $duration = (float) $config['duration'];

        if ($totalSizeKg <= 0 || $duration <= 0) {
            return null;
        }

        // Get settings
        $kgPerBag = (float) ServiceSetting::getSetting($serviceId, 'Average Kg per bag', 0);
        $pricePerBag = (float) ServiceSetting::getSetting($serviceId, 'Average price Per Bag', 0);
        $bagsPerAgentPerMonth = (float) ServiceSetting::getSetting($serviceId, 'Average # of Bags Per Agent Per Month', 0);
        $commissionRate = (float) ServiceSetting::getSetting($serviceId, 'Average Agent Commission Percentage', 0) / 100;
        $deliveryCost = (float) ServiceSetting::getSetting($serviceId, 'Delivery Cost Per Agent Per Month', 0);
        $trainingCost = (float) ServiceSetting::getSetting($serviceId, 'Training Per Agent', 0);

        if ($kgPerBag <= 0) return null;

        $estimatedBags = $totalSizeKg / $kgPerBag;
        $totalAgents = $bagsPerAgentPerMonth > 0 ? $estimatedBags / ($bagsPerAgentPerMonth * $duration) : 0;

        $totalAgentSubscriptions = ($pricePerBag * $bagsPerAgentPerMonth) * $commissionRate;
        $totalAgentCostOfDelivery = $totalAgents * $duration * $deliveryCost;
        $totalCostRecruitmentTraining = $trainingCost * $totalAgents;

        $total = round($totalAgentSubscriptions + $totalAgentCostOfDelivery + $totalCostRecruitmentTraining, 2);

        return [
            'total' => $total,
            'breakdown' => [
                ['label' => 'Total agents', 'value' => number_format($totalAgents, 2)],
                ['label' => 'Total bags', 'value' => number_format($estimatedBags, 2)],
                ['label' => 'Agent subscriptions', 'value' => number_format($totalAgentSubscriptions, 2)],
                ['label' => 'Delivery costs', 'value' => number_format($totalAgentCostOfDelivery, 2)],
                ['label' => 'Training costs', 'value' => number_format($totalCostRecruitmentTraining, 2)],
            ]
        ];
    }

    public function proceed()
    {
        $selectedServices = [];
        $serviceConfigs = [];
        $serviceBreakdowns = [];
        $coreServiceTotal = 0;

        foreach ($this->services as $service) {
            $config = $this->serviceConfigs[$service->id];
            if (!$config['selected']) continue;

            if (!$config['quantity'] || !$config['unit_id'] || !$config['duration']) {
                $this->notify('warning', "Please complete all fields for {$service->name}");
                return;
            }

            $selectedServices[] = $service->id;
            $serviceConfigs[$service->id] = [
                'quantity' => $config['quantity'],
                'unit_id' => $config['unit_id'],
                'duration' => $config['duration'],
            ];

            $breakdown = $this->getServiceBreakdown($service->id);
            if ($breakdown) {
                $serviceBreakdowns[$service->id] = $breakdown;
                $coreServiceTotal += $breakdown['total'];
            }
        }

        if (empty($selectedServices)) {
            $this->notify('warning', 'Please select at least one service');
            return;
        }

        session([
            'selected_service_ids' => $selectedServices,
            'selected_service_configs' => $serviceConfigs,
            'service_breakdowns' => $serviceBreakdowns,
            'core_service_total' => $coreServiceTotal,
        ]);

        return redirect()->route('filament.admin.pages.service-features');
    }

    protected function getFormSchema(): array
    {
        return [];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }
}