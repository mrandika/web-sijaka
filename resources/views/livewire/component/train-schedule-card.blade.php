<div class="card schedule-card" wire:click="schedule_detail" onclick="location.href='#'" style="cursor: pointer;">
    <div class="card-header">
        <div>
            <h4>{{ $schedule->train->name }}</h4>
            @if(isset($schedule->origin_station) && isset($schedule->destination_station))
            <span class="badge badge-info">
                {{ $schedule->origin_station->code }} <i class="fa fa-arrow-right"></i> {{ $schedule->destination_station->code }}
            </span>
            @endif
            <span class="badge badge-light">
                @if ($schedule->status() == "Kereta Disiapkan")
                    <i class="fa fa-train"></i>
                @elseif($schedule->status() == "Persiapan Pemberangkatan")
                    <i class="fa fa-arrow-up"></i>
                @elseif($schedule->status() == "Dalam Perjalanan")
                    <i class="fa fa-clock"></i>
                @elseif($schedule->status() == "Sampai di Tujuan")
                    <i class="fa fa-check"></i>
                @endif
                {{ $schedule->status() }}
            </span>
        </div>
    </div>
    <div class="card-footer bg-whitesmoke">
        Waktu Tempuh: {{ $schedule->duration() }}
    </div>
</div>
