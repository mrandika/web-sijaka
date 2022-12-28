@section('page')
    Station
@endsection

@section('station_active')
    active
@endsection

@extends('layouts.navigation.sijaka-navigation')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Stasiun</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('app') }}">Homepage</a></div>
                <div class="breadcrumb-item">Data Stasiun</div>
            </div>
        </div>

        <div class="section-body">
            @forelse($stations as $station)
                <livewire:component.station-card :station="$station">
            @empty
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400" style="height: 400px;">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>Data Stasiun Belum Tersedia.</h2>
                            <p class="lead">
                                Data stasiun KA belum tersedia. Silahkan cek kembali nanti.
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</div>
