<?php

use Jalez\SportCalender\Repository\EventRepository;

require_once '../../vendor/autoload.php';

$eventRepository = new EventRepository();

$events = $eventRepository->findAllInRange();

header('Content-Type: application/json');

echo json_encode($events);