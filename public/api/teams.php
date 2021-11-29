<?php

use Jalez\SportCalender\Repository\TeamRepository;

require_once '../../vendor/autoload.php';

$teamRepository = new TeamRepository();

$teams = $teamRepository->findAll();

header('Content-Type: application/json');

echo json_encode($teams);