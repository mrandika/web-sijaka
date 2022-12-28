<div class="card" wire:click="station_detail" onclick="location.href='#'" style="cursor: pointer;">
    <div class="card-header">
        <div>
            <h4>{{ $station->name }}</h4>
            <span class="badge badge-light">
                {{ $station->depart_schedule->count() }} Keberangkatan
            </span>
            <span class="badge badge-light">
                {{ $station->arrive_schedule->count() }} Kedatangan
            </span>
        </div>
    </div>
    <div class="card-footer bg-whitesmoke">
        Pembaruan terakhir pada {{ $station->updated_at }}
    </div>
</div>
