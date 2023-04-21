<?php

require_once __DIR__ . "/../Models/Places.php";

const CSV_DATA = __DIR__ . "/../data/places.csv";


function run():void {
    $placesProcessor = new \Vasiliishvakin\PhpTest\Models\Places();
    $placesProcessor->loadFromCSV(CSV_DATA);
    $places = $placesProcessor->getPlaces();

    if (!isset($_GET["action"])) {



        //var_dump($places);
    } else {
        $placeId = (int)$_GET["place"];
        $place = $places[$placeId];
        $length = (int) $_GET["length"];

        $nearest = $placesProcessor->findNearests($place, $length);
        var_dump($nearest);
    }
    require_once __DIR__ . "/../views/index.php";

}

run();




