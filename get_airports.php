<?php
$airports = [];

if (($handle = fopen("airports.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $airports[] = [
            'code' => $data[4],  // IATA code
            'name' => $data[1],  // Airport name
            'city' => $data[2],  // City name
            'country' => $data[3] // Country name
        ];
    }
    fclose($handle);
}

header('Content-Type: application/json');
echo json_encode($airports);