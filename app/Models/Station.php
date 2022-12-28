<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'name'
    ];

    public function code(): Attribute {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }

    public function depart_schedule()
    {
        return $this->hasMany(TrainSchedule::class, 'origin_station_id');
    }

    public function arrive_schedule()
    {
        return $this->hasMany(TrainSchedule::class, 'destination_station_id');
    }

    public function transit_schedule()
    {
        return $this->hasMany(TrainSchedule::class, 'current_station_id');
    }
}
