<?php

namespace App\Services\Traits;

use App\Services\Location\Coordinate;

trait TaskLocationTrait
{
    /**
     * @param \App\Models\Task $task
     * @param array $locations
     */
    public function createLocation($task, $locations)
    {
        if (empty($locations)) {
            return true;
        }

        $locationData = [];
        foreach ($locations as $order => $location) {
            $coordinate = Coordinate::parse($location['coordinate']);
            $locationData[] = [
                'name'              => $location['name'],
                'address'           => $location['address'],
                'long'              => $coordinate->longitude(),
                'lat'               => $coordinate->latitude(),
                'sort'              => $order,
                'phone_number'      => $location['phone_number'],
                'open_time'         => $location['open_time'],
                'close_time'        => $location['close_time'],
                'status'            => ACTIVE_LOCATION_TASK,
            ];
        }

        if (!empty($locationData)) {
            $task->locations()->createMany($locationData);
        }

        return true;
    }

    /**
     * @param $task
     * @param $locations
     *
     * @return bool|void
     */
    public function updateLocation($task, $locations)
    {
        if (empty($locations)) {
            return true;
        }

        foreach ($locations as $location) {
            $coordinate = Coordinate::parse($location['coordinate']);

            $locationData = [
                'name'    => $location['name'],
                'address' => $location['address'],
                'long'    => $coordinate->longitude(),
                'lat'     => $coordinate->latitude(),
            ];

            $task->locations()->where('id', $location['id'])->update($locationData);
        }
    }
}
