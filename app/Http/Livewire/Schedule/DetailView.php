<?php

namespace App\Http\Livewire\Schedule;

use App\Models\TrainSchedule;
use Livewire\Component;

class DetailView extends Component
{
    public $schedule_id;
    public $schedule;

    public function getListeners()
    {
        return [
            "echo:schedule-updated.{$this->schedule_id},TrainScheduleUpdated" => '$refresh',
        ];
    }

    public function mount($schedule_id)
    {
        $this->schedule_id = $schedule_id;
        $this->schedule = TrainSchedule::findOrFail($this->schedule_id);
    }

    public function render()
    {
        return view('livewire.schedule.detail-view', ['schedule' => $this->schedule])
            ->extends('layouts.sijaka-main')
            ->section('main');
    }
}
