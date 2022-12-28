<?php

namespace App\Http\Controllers\Api;

use App\Events\StationScheduleAdded;
use App\Events\TrainScheduleAdded;
use App\Events\TrainScheduleUpdated;
use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\Train;
use App\Models\TrainSchedule;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Set the train origin (station) to the schedule data
     */
    public function set_origin(Request $request)
    {
        // Get the raw data from HTTP request
        $topic = $request->topic;
        $data = $request->data;

        // Get the train data, explode from the topic
        $train_data = explode("/", $topic);

        // Train data, and data adjustment
        $train_code = $train_data[2];
        $train_origin = $data;
        $train_name = strtoupper(str_replace('_', ' ', $train_code));
        $origin_station_name = strtoupper(str_replace('_', ' ', $train_origin));

        // Create the train if not exist, or get the first object if exist
        $train = Train::firstOrCreate(
            ['code' => $train_code, 'name' => 'KA '.$train_name]
        );

        // Create the station if not exist, or get the first object if exist
        $station = Station::firstOrCreate(
            ['code' => $train_origin, 'name' => 'STASIUN '.$origin_station_name]
        );

        // Create the schedule if not exist, or update the object if exist
        $schedule = TrainSchedule::updateOrCreate(
            ['train_id' => $train->id],
            ['train_id' => $train->id, 'origin_station_id' => $station->id]
        );

        // Publish an event to app
        if ($schedule->wasRecentlyCreated) {
            event(new TrainScheduleAdded());
            event(new StationScheduleAdded($station->id));
        } else {
            event(new TrainScheduleUpdated($schedule->id));
        }

        // Response the request
        return response()->json([
            'code' => 200,
            'message' => 'Train origin received.',
            'data' => $schedule
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Set the train destination (station) to the schedule data
     */
    public function set_destination(Request $request)
    {
        // Get the raw data from HTTP request
        $topic = $request->topic;
        $data = $request->data;

        // Get the train data, explode from the topic
        $train_data = explode("/", $topic);

        // Train data, and data adjustment
        $train_code = $train_data[2];
        $train_destination = $data;
        $train_name = strtoupper(str_replace('_', ' ', $train_code));
        $destination_station_name = strtoupper(str_replace('_', ' ', $train_destination));

        // Create the train if not exist, or get the first object if exist
        $train = Train::firstOrCreate(
            ['code' => $train_code, 'name' => 'KA '.$train_name]
        );

        // Create the station if not exist, or get the first object if exist
        $station = Station::firstOrCreate(
            ['code' => $train_destination, 'name' => 'STASIUN '.$destination_station_name]
        );

        // Create the schedule if not exist, or update the object if exist
        $schedule = TrainSchedule::updateOrCreate(
            ['train_id' => $train->id],
            ['train_id' => $train->id, 'destination_station_id' => $station->id]
        );

        // Publish an event to app
        if ($schedule->wasRecentlyCreated) {
            event(new TrainScheduleAdded());
            event(new StationScheduleAdded($station->id));
        } else {
            event(new TrainScheduleUpdated($schedule->id));
        }

        // Response the request
        return response()->json([
            'code' => 200,
            'message' => 'Train destination received.',
            'data' => $schedule
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Set the current train location (last station) to the schedule data
     */
    public function set_location(Request $request)
    {
        // Get the raw data from HTTP request
        $topic = $request->topic;
        $data = $request->data;

        // Get the train data, explode from the topic
        $train_data = explode("/", $topic);

        // Train data, and data adjustment
        $train_code = $train_data[2];
        $train_location = $data;
        $train_name = strtoupper(str_replace('_', ' ', $train_code));
        $current_station_name = strtoupper(str_replace('_', ' ', $train_location));

        // Create the train if not exist, or get the first object if exist
        $train = Train::firstOrCreate(
            ['code' => $train_code, 'name' => 'KA '.$train_name]
        );

        // Create the station if not exist, or get the first object if exist
        $station = Station::firstOrCreate(
            ['code' => $train_location, 'name' => 'STASIUN '.$current_station_name]
        );

        // Create the schedule if not exist, or update the object if exist
        $schedule = TrainSchedule::updateOrCreate(
            ['train_id' => $train->id],
            ['train_id' => $train->id, 'current_station_id' => $station->id]
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
            'message' => 'Train location received.',
            'data' => $schedule
        ]);
    }
}
