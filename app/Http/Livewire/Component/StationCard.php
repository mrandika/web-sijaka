<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class StationCard extends Component
{
    public $station;

    public function mount($station)
    {
        $this->station = $station;
    }

    public function render()
    {
        return view('livewire.component.station-card');
    }

    public function redirect_page(string $route_name, $param = null)
    {
        if (isset($param)) {
            return redirect()->route($route_name, $param);
        } else {
            return redirect()->route($route_name);
        }
    }

    public function station_detail()
    {
        $this->redirect_page('station.detail', $this->station->id);
    }
}
