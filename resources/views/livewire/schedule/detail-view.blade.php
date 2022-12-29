@section('page')
{{ $schedule->train->name }}
@endsection

@section('schedule_active')
    active
@endsection

@extends('layouts.navigation.sijaka-navigation')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('app') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>

            <h1>{{ $schedule->train->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app') }}">Homepage</a></div>
                <div class="breadcrumb-item"><a href="{{ route('app') }}">Jadwal KA</a></div>
                <div class="breadcrumb-item">{{ $schedule->train->name }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi KA</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">Nama KA</th>
                            <td>{{ $schedule->train->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Stasiun Pemberangkatan</th>
                            <td>@if(isset($schedule->origin_station)) {{ $schedule->origin_station->name }} @else Stasiun Pemberangkatan belum tersedia @endif <br>
                                <small>@if(isset($schedule->depart_time)) {{ $schedule->depart_time }} @else Waktu pemberangkatan belum tersedia @endif</small></td>
                        </tr>
                        <tr>
                            <th scope="row">Stasiun Tujuan</th>
                            <td>@if(isset($schedule->destination_station)) {{ $schedule->destination_station->name }} @else Stasiun Tujuan belum tersedia @endif <br>
                                <small>@if(isset($schedule->arrive_time)) {{ $schedule->arrive_time }} @else Waktu tiba belum tersedia @endif</small></td>
                        </tr>
                        <tr>
                            <th scope="row">Lokasi KA</th>
                            <td>@if(isset($schedule->current_station)) {{ $schedule->current_station->name }} @else Lokasi KA tidak tersedia @endif</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-whitesmoke">
                    Pembaruan terakhir pada {{ $schedule->updated_at }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Perjalanan KA</h4>
                </div>
                <div class="card-body">
                    <div class="activities">
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-train"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2 @if ($schedule->status() == "Kereta Disiapkan") beep @endif">
                                    <span class="text-job text-primary">Persiapan KA</span>
                                </div>
                                <p>Mempersiapkan {{ $schedule->train->name }}
                                    @if(isset($schedule->origin_station) && isset($schedule->destination_station))
                                        untuk rute {{ $schedule->origin_station->name }} - {{ $schedule->destination_station->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if ($schedule->status() != "Kereta Disiapkan")
                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                                <div class="activity-detail">
                                    <div class="mb-2 @if ($schedule->status() == "Persiapan Pemberangkatan") beep @endif">
                                        <span class="text-job text-primary">Persiapan Pemberangkatan</span>
                                    </div>
                                    <p>Kereta dipersiapkan untuk pemberangkatan dari {{ $schedule->origin_station->name }} @isset($schedule->depart_time) pada {{ $schedule->depart_time }} @endisset</p>
                                </div>
                            </div>
                            @if ($schedule->status() != "Persiapan Pemberangkatan")
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="activity-detail">
                                        <div class="mb-2 @if ($schedule->status() == "Dalam Perjalanan") beep @endif">
                                            <span class="text-job">Dalam Perjalanan</span>
                                        </div>
                                        <p>Lokasi terakhir: @if(isset($schedule->current_station)) {{ $schedule->current_station->name }} @else Lokasi KA tidak tersedia @endif</p>
                                    </div>
                                </div>
                                @if ($schedule->status() != "Dalam Perjalanan")
                                    <div class="activity">
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="fas fa-arrow-down"></i>
                                        </div>
                                        <div class="activity-detail">
                                            <div class="mb-2">
                                                <span class="text-job"><i class="fa fa-check"></i> Sampai di Tujuan</span>
                                            </div>
                                            <p>Kereta sudah tiba pada {{ $schedule->destination_station->name }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
