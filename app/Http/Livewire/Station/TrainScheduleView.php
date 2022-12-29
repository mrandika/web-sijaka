<?php

namespace App\Http\Livewire\Station;

use App\Models\Station;
use Livewire\Component;

class TrainScheduleView extends Component
{
    public $station_id;
    public $station, $schedules;

    public function getListeners()
    {
        return [
            "echo:station-schedule-added.{$this->station_id},StationScheduleAdded" => 'refresh_data',
            'refreshComponent' => '$refresh'
        ];
    }

    public function mount($station_id)
    {
        $this->station_id = $station_id;
        $this->station = Station::findOrFail($this->station_id);

        $this->schedules = $this->station->depart_schedule->merge($this->station->arrive_schedule);
    }

    public function render()
    {
        return view('livewire.station.train-schedule-view')
            ->extends('layouts.sijaka-main')
            ->section('main');
    }

    public function refresh_data()
    {
        $this->station = Station::findOrFail($this->station_id);
        $this->schedules = $this->station->depart_schedule->merge($this->station->arrive_schedule);
        $this->emit('refreshComponent');
    }
}
