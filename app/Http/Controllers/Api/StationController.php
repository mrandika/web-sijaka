<?php

namespace App\Http\Controllers\Api;

use App\Events\TrainScheduleAdded;
use App\Events\TrainScheduleUpdated;
use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\Train;
use App\Models\TrainSchedule;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Set the train depart time (from origin station) to the schedule data
     */
    public function set_train_depart(Request $request)
    {
        // Get the raw data from HTTP request
        $topic = $request->topic;
        $data = $request->data;

        // Get the schedule data, explode from the topic
        $schedule_data = explode("/", $topic);

        // Schedule, train, and station data, and data adjustment
        $station_code = $schedule_data[2];
        $train_code = $schedule_data[4];
        $train_name = strtoupper(str_replace('_', ' ', $train_code));
        $station_name = strtoupper(str_replace('_', ' ', $station_code));

        // Create the train if not exist, or get the first object if exist
        $train = Train::firstOrCreate(
            ['code' => $train_code, 'name' => 'KA '.$train_name]
        );

        // Create the station if not exist, or get the first object if exist
        Station::firstOrCreate(
            ['code' => $station_code, 'name' => 'STASIUN '.$station_name]
        );

        // Create the schedule if not exist, or update the object if exist
        $schedule = TrainSchedule::updateOrCreate(
            ['train_id' => $train->id],
            ['train_id' => $train->id, 'depart_time' => $data]
        );

        // Publish an event to app
        if ($schedule->wasRecentlyCreated) {
            event(new TrainScheduleAdded());
        } else {
            event(new TrainScheduleUpdated($schedule->id));
        }

        // Response the request
        return response()->json([
            'code' => 200,
            'message' => 'Train schedule (depart time) received.',
            'data' => $schedule
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Set the train arrive time (at destination station) to the schedule data
     */
    public function set_train_arrive(Request $request)
    {
        // Get the raw data from HTTP request
        $topic = $request->topic;
        $data = $request->data;

        // Get the schedule data, explode from the topic
        $schedule_data = explode("/", $topic);

        // Schedule, train, and station data, and data adjustment
        $station_code = $schedule_data[2];
        $train_code = $schedule_data[4];
        $train_name = strtoupper(str_replace('_', ' ', $train_code));
        $station_name = strtoupper(str_replace('_', ' ', $station_code));

        // Create the train if not exist, or get the first object if exist
        $train = Train::firstOrCreate(
            ['code' => $train_code, 'name' => 'KA '.$train_name]
        );

        // Create the station if not exist, or get the first object if exist
        Station::firstOrCreate(
            ['code' => $station_code, 'name' => 'STASIUN '.$station_name]
        );

        // Create the schedule if not exist, or update the object if exist
        $schedule = TrainSchedule::updateOrCreate(
            ['train_id' => $train->id],
            ['train_id' => $train->id, 'arrive_time' => $data]
        );

        // Publish an event to app
        if ($schedule->wasRecentlyCreated) {
            event(new TrainScheduleAdded());
        } else {
            event(new TrainScheduleUpdated($schedule->id));
        }

        // Response the request
        return response()->json([
            'code' => 200,
            'message' => 'Train schedule (arrive time) received.',
            'data' => $schedule
        ]);
    }
}
