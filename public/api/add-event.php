<?php

use Jalez\SportCalender\Repository\EventRepository;

require_once '../../vendor/autoload.php';

$eventRepository = new EventRepository();

if (!isset(
    $_POST['dateTime'],
    $_POST['team1id'],
    $_POST['team2id'],
    $_POST['locationId'],
    $_POST['categoryId'],
)) {
    http_response_code(400);
    echo 'You did not provide all data';
    exit;
}

$dateTime = new DateTime($_POST['dateTime']);
$team1id = $_POST['team1id'];
$team2id = $_POST['team2id'];
$locationId = $_POST['locationId'];
$categoryId = $_POST['categoryId'];

$eventId = $eventRepository->create(
    $dateTime,
    $team1id,
    $team2id,
    $locationId,
    $categoryId,
);

if (!$eventId) {
    http_response_code(400);
    echo 'We could not create the event. Are you sure the provided IDs are correct?';
    exit;
}

header('Content-Type: application/json');

echo json_encode($eventId);