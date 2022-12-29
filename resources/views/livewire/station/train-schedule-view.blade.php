@section('page')
    Jadwal {{ $station->name }}
@endsection

@section('station_active')
    active
@endsection

@extends('layouts.navigation.sijaka-navigation')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('station.detail', $station_id) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>

            <h1>Jadwal {{ $station->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app') }}">Homepage</a></div>
                <div class="breadcrumb-item"><a href="{{ route('station.index') }}">Data Stasiun</a></div>
                <div class="breadcrumb-item"><a href="{{ route('station.detail', $station_id) }}">{{ $station->name }}</a></div>
                <div class="breadcrumb-item">Jadwal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama KA</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Waktu Keberangkatan</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($schedules->sortByDesc('created_at') as $schedule)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $schedule->train->name }}</td>
                                <td>
                                    @if(isset($schedule->destination_station))
                                        {{ $schedule->destination_station->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($schedule->arrive_time))
                                        {{ $schedule->arrive_time }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
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
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-header bg-whitesmoke">
                    Pembaruan terakhir pada {{ $schedules->sortByDesc('created_at')->first()->updated_at }}
                </div>
            </div>
        </div>
    </section>
</div>
