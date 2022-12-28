<?php

namespace App\Http\Livewire;

use App\Models\Station;
use Livewire\Component;

class StationView extends Component
{
    public function render()
    {
        $stations = Station::all();

        return view('livewire.station-view', ['stations' => $stations])
            ->extends('layouts.sijaka-main')
            ->section('main');
    }
}
