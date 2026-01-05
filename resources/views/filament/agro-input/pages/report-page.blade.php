<x-filament-panels::page>
    <div class="w-full h-screen">
        @if(auth()->user()->teams->first()->name == 'Golden Fertiliser')
        <iframe
            title="FMAN Report"
            class="w-full h-full border-none"
            src="https://app.powerbi.com/view?r=eyJrIjoiNjEwMmFmMzQtNmQ0Mi00NTVkLWFjYzUtMGE3MThiNmRjNTA2IiwidCI6IjU4ODBmZDMzLTYyZmEtNGM0Ny1iYTFmLWJhMWE1ODM5Mjc2NyJ9" frameborder="0"
            allowFullScreen="true">
        </iframe>
        @elseif(auth()->user()->teams->first()->name == 'Mafa')
        <iframe 
            title="Mafa Analysis Report" 
            class="w-full h-full border-none"
            src="https://app.powerbi.com/view?r=eyJrIjoiMzYzNGZlMDQtZWU0Ni00OTU4LTkyNTItODhkNTZkMDlmYTM1IiwidCI6IjU4ODBmZDMzLTYyZmEtNGM0Ny1iYTFmLWJhMWE1ODM5Mjc2NyJ9" 
            frameborder="0" 
            allowFullScreen="true">
        </iframe>
        @else
        <iframe 
            title="Mafa Analysis Report" 
            class="w-full h-full border-none"
            src="https://app.powerbi.com/view?r=eyJrIjoiMzYzNGZlMDQtZWU0Ni00OTU4LTkyNTItODhkNTZkMDlmYTM1IiwidCI6IjU4ODBmZDMzLTYyZmEtNGM0Ny1iYTFmLWJhMWE1ODM5Mjc2NyJ9" 
            frameborder="0" 
            allowFullScreen="true">
        </iframe>
        @endif
    </div>
</x-filament-panels::page>
