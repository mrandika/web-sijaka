<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('mqtt/connection_test', \App\Http\Livewire\MessageView::class);

Route::get('/', \App\Http\Livewire\MainView::class)->name('app');
Route::get('station', \App\Http\Livewire\StationView::class)->name('station.index');
Route::get('station/{station_id}', \App\Http\Livewire\Station\DetailView::class)->name('station.detail');
Route::get('schedule/{schedule_id}', \App\Http\Livewire\Schedule\DetailView::class)->name('schedule.detail');
