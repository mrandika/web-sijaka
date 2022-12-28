@section('page')
    Homepage
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        .schedule-card:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection

@section('schedule_active')
    active
@endsection

@extends('layouts.navigation.sijaka-navigation')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal Kereta Api</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app') }}">Homepage</a></div>
                <div class="breadcrumb-item">Jadwal KA</div>
            </div>
        </div>

        <div class="section-body">
            @forelse($schedules->sortByDesc('created_at') as $schedule)
                <livewire:component.train-schedule-card :schedule="$schedule" :key="'schedule-'.$schedule->id">
            @empty
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400" style="height: 400px;">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>Data Jadwal Belum Tersedia.</h2>
                            <p class="lead">
                                Data pemberangkatan Kereta Api belum tersedia. Silahkan cek kembali nanti.
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</div>

@section('js')
    <script src="{{ asset('js/select2.full.js') }}"></script>
@endsection
