<?php

use Jalez\SportCalender\Repository\CategoryRepository;

require_once '../../vendor/autoload.php';

$categoryRepository = new CategoryRepository();

$categories = $categoryRepository->findAll();

header('Content-Type: application/json');

echo json_encode($categories);