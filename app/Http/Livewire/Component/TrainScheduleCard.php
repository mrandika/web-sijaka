<?php

namespace App\Http\Livewire\Component;

use Illuminate\Console\Scheduling\Schedule;
use Livewire\Component;

class TrainScheduleCard extends Component
{
    public $schedule;

    public function getListeners()
    {
        return [
            "echo:schedule-updated.{$this->schedule->id},TrainScheduleUpdated" => '$refresh',
        ];
    }

    public function mount($schedule)
    {
        $this->schedule = $schedule;
    }

    public function render()
    {
        return view('livewire.component.train-schedule-card');
    }

    public function redirect_page(string $route_name, $param = null)
    {
        if (isset($param)) {
            return redirect()->route($route_name, $param);
        } else {
            return redirect()->route($route_name);
        }
    }

    public function schedule_detail()
    {
        $this->redirect_page('schedule.detail', $this->schedule->id);
    }
}
