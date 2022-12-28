<?php

namespace App\Http\Livewire\Station;

use App\Models\Station;
use Livewire\Component;

class DetailView extends Component
{
    public $station_id;
    public $station;

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
    }

    public function render()
    {
        return view('livewire.station.detail-view', ['station' => $this->station])
            ->extends('layouts.sijaka-main')
            ->section('main');
    }

    public function refresh_data()
    {
        $this->station = Station::findOrFail($this->station_id);
        $this->emit('refreshComponent');
    }
}
