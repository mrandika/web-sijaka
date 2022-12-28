@section('page')
    {{ $station->name }}
@endsection

@section('station_active')
    active
@endsection

@extends('layouts.navigation.sijaka-navigation')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('station.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>

            <h1>{{ $station->name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app') }}">Homepage</a></div>
                <div class="breadcrumb-item"><a href="{{ route('station.index') }}">Data Stasiun</a></div>
                <div class="breadcrumb-item">{{ $station->name }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Stasiun</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Stasiun</th>
                            <td>{{ $station->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Pemberangkatan</th>
                            <td>{{ $station->depart_schedule->count() }} kereta akan diberangkatkan</td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Kedatangan</th>
                            <td>{{ $station->arrive_schedule->count() }} kereta akan datang</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-whitesmoke">
                    Pembaruan terakhir pada {{ $station->updated_at }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Pemberangkatan</h4>
                </div>
                <div class="card-body">
                    @forelse($station->depart_schedule as $schedule)
                        <livewire:component.train-schedule-card :schedule="$schedule" :key="'schedule-'.$schedule->id">
                    @empty
                        <div class="empty-state" data-height="400" style="height: 400px;">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>Data Keberangkatan Belum Tersedia.</h2>
                            <p class="lead">
                                Data pemberangkatan Kereta Api pada stasiun ini belum tersedia. Silahkan cek kembali nanti.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Kedatangan</h4>
                </div>
                <div class="card-body">
                    @forelse($station->arrive_schedule as $schedule)
                        <livewire:component.train-schedule-card :schedule="$schedule" :key="'schedule-'.$schedule->id">
                    @empty
                        <div class="empty-state" data-height="400" style="height: 400px;">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>Data Kedatangan Belum Tersedia.</h2>
                            <p class="lead">
                                Data kedatangan Kereta Api pada stasiun ini belum tersedia. Silahkan cek kembali nanti.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
