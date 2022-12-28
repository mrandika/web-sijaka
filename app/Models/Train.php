<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Train extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'name'
    ];

    public function schedules()
    {
        return $this->hasMany(TrainSchedule::class);
    }
}
