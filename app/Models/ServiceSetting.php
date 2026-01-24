<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    use HasFactory;

    /**
     * Get the service that owns the service setting.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
