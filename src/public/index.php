<?php

require_once __DIR__ . "/../Models/Places.php";

const CSV_DATA = __DIR__ . "/../data/places.csv";


function main():void {
    $placesProcessor = new \Vasiliishvakin\PhpTest\Models\Places();
    $placesProcessor->loadFromCSV(CSV_DATA);
    $places = $placesProcessor->getPlaces();

    $queries = [];
    parse_str($_SERVER['QUERY_STRING'], $queries);

    if (!isset($queries["place"])) {
        require_once __DIR__ . "/../views/index.php";
    } else {
        $placeId = (int)$queries["place"];
        $place = $places[$placeId];
        $length = (int) $queries["length"];

        $nearest = $placesProcessor->findNearests($place, $length);

        require_once __DIR__ . "/../views/nearest.php";
    }
}

//I am know it is not c++, sorry.
main();




