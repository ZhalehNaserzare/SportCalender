<?php

use Jalez\SportCalender\Repository\TeamRepository;

require_once '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImMutable(__DIR__ . '\..\..');
$dotenv->load();

$teamRepository = new TeamRepository();

$name = $_POST['name'] ?? null;
$homecity = $_POST['homecity'] ?? null;
$name = trim($name);
$homecity = trim($homecity);

if (!$name) {
    http_response_code(400);
    echo 'no name provided!';
}
if (!$homecity) {
    http_response_code(400);
    echo 'no homecity provided!';
}

$id = $teamRepository->create($name, $homecity);

header('Content-Type: application/json');

echo json_encode($id);