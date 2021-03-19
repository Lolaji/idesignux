<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'settings' => 'object'
    ];

    public function metadatas ()
    {
        return $this->morphMany(Metadata::class, 'metable');
    }

    public function subservice ()
    {
        return $this->belongsToMany($this, 'sub_services', 'service_id', 'sub_service_id');
    }

    public function milestones ()
    {
        return $this->hasMany(ServiceMilestone::class);
    }

    public function deliverables ()
    {
        return $this->hasMany(ServiceDeliverable::class);
    }

    public function processes ()
    {
        return $this->hasMany(ServiceProcess::class);
    }

    public function images ()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'service_portfolios');
    }
}
