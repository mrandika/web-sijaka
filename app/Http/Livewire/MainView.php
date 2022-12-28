<?php

namespace App\Http\Livewire;

use App\Models\Station;
use App\Models\TrainSchedule;
use Livewire\Component;

class MainView extends Component
{
    public $schedules;

    protected $listeners = [
        'echo:schedule-added,TrainScheduleAdded' => 'refresh_schedule',
        'refreshComponent' => '$refresh'
    ];

    public function get_schedules()
    {
        $this->schedules = TrainSchedule::get();
    }

    public function refresh_schedule()
    {
        $this->get_schedules();
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $stations = Station::all();
        $this->get_schedules();

        return view('livewire.main-view', ['stations' => $stations, 'schedules' => $this->schedules])
            ->extends('layouts.sijaka-main')
            ->section('main');
    }
}
