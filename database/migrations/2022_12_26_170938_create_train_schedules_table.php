<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('train_id');
            $table->foreignUuid('origin_station_id')->nullable();
            $table->foreignUuid('destination_station_id')->nullable();
            $table->foreignUuid('current_station_id')->nullable();
            $table->dateTime('depart_time')->nullable();
            $table->dateTime('arrive_time')->nullable();
            $table->timestamps();

            $table->foreign('train_id')->references('id')->on('trains')->onDelete('cascade');
            $table->foreign('origin_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('destination_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('current_station_id')->references('id')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('train_schedules');
    }
};
