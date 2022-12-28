@extends('layouts.app')

@section('content')
    <div class="main-wrapper container">
        @yield('main-topbar')

        <!-- Main Content -->
        @yield('main')

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; SIJAKA {{ date('Y') }} <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">
                Template: 2.3.0 &mdash; {{ env('APP_NAME') }}: {{ env('APP_VERSION') }}
            </div>
        </footer>
    </div>

@endsection
