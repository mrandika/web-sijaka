<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainSchedule extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'train_id',
        'origin_station_id',
        'destination_station_id',
        'current_station_id',
        'depart_time',
        'arrive_time'
    ];

    public function status()
    {
        $origin_station_id = $this->attributes['origin_station_id'];
        $destination_station_id = $this->attributes['destination_station_id'];
        $current_station_id = $this->attributes['current_station_id'];

        $status = null;

        if ($current_station_id == null)  {
            $status = 'Kereta Disiapkan';
        } else if ($current_station_id == $origin_station_id) {
            $status = 'Persiapan Pemberangkatan';
        } else if ($current_station_id == $destination_station_id) {
            $status = 'Sampai di Tujuan';
        } else {
            $status = 'Dalam Perjalanan';
        }

        return $status;
    }

    public function duration()
    {
        try {
            $depart_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['depart_time'], 'Asia/Jakarta');
            $arrive_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['arrive_time'], 'Asia/Jakarta');

            return $arrive_time->diff($depart_time)->format('%h jam %i menit');;
        } catch (InvalidFormatException) {
            return "-";
        }
    }

    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    public function origin_station()
    {
        return $this->belongsTo(Station::class, 'origin_station_id');
    }

    public function destination_station()
    {
        return $this->belongsTo(Station::class, 'destination_station_id');
    }

    public function current_station()
    {
        return $this->belongsTo(Station::class, 'current_station_id');
    }
}
