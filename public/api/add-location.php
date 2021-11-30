<?php

use Jalez\SportCalender\Repository\LocationRepository;

require_once '../../vendor/autoload.php';

$locationRepository = new LocationRepository();

$name = $_POST['name'] ?? null;
$name = trim($name);
if (!$name) {
    http_response_code(400);
    echo 'no name provided!';
}

$id = $locationRepository->create($name);

header('Content-Type: application/json');

echo json_encode($id);