<?php

namespace Vasiliishvakin\PhpTest\Models;

class Places
{
    const earthRadius = 6371000;
    protected array $places;

    public function __construct()
    {

    }

    public function loadFromCSV(string $path): void
    {
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf("file $path not found", $path));
        }

        $csv = array_map('str_getcsv', file($path));
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv);
        foreach ($csv as &$place) {
            $place["coordinates"] = explode(',', $place["coordinates"]);

        }
        $this->places = $csv;
    }

    public function getPlaces():array
    {
        return $this->places;
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Vincenty formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    public function calcDestByPoints($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo ):float
    {
        // convert from degrees to radians
        $latFrom = ($latitudeFrom);
        $lonFrom = ($longitudeFrom);
        $latTo = ($latitudeTo);
        $lonTo = ($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return round(($angle * self::earthRadius) / 1000, 0);
    }

    public function calcDestByPlaces($placeA, $placeB)
    {
        $latFrom = $placeA["coordinates"][0];
        $lonFrom = $placeA["coordinates"][1];
        $latTo = $placeB["coordinates"][0];
        $lonTo = $placeB["coordinates"][1];
        return $this->calcDestByPoints($latFrom, $lonFrom, $latTo, $lonTo);
    }

    public function findNearests($place, $length)
    {
        $nearest = [];
        $places = $this->getPlaces();
        foreach ($places as $testPlace) {
            if ($testPlace === $place) {
                continue;
            }
            $lengthBeetwen = $this->calcDestByPlaces($place, $testPlace);
            if ($lengthBeetwen > $length) {
                continue;
            }
            $nearest[$testPlace["name"]] =  $lengthBeetwen;
        }

        asort($nearest);
        return $nearest;
    }
}