@section('main-topbar')
    <nav class="navbar navbar-expand-lg main-navbar bg-primary">
        <a href="{{ route('app') }}" class="navbar-brand sidebar-gone-hide">{{ env('APP_NAME') }}</a>
        <div class="navbar-nav">
            <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
        <div class="nav-collapse">
            <ul class="navbar-nav">
                <li class="nav-item @yield('schedule_active')"><a href="{{ route('app') }}" class="nav-link">Jadwal KA</a></li>
                <li class="nav-item @yield('station_active')"><a href="{{ route('station.index') }}" class="nav-link">Data Stasiun</a></li>
            </ul>
        </div>
    </nav>
@endsection
