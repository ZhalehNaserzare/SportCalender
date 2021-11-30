<?php

use Jalez\SportCalender\Repository\EventRepository;

require_once '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImMutable(__DIR__ . '\..\..');
$dotenv->load();

$eventRepository = new EventRepository();

$events = $eventRepository->findAllInRange();

header('Content-Type: application/json');

echo json_encode($events);