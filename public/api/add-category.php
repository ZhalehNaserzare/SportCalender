<?php

use Jalez\SportCalender\Repository\CategoryRepository;

require_once '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImMutable(__DIR__ . '\..\..');
$dotenv->load();

$categoryRepository = new CategoryRepository();

$name = $_POST['name'] ?? null;
$name = trim($name);
if (!$name) {
    http_response_code(400);
    echo 'no name provided!';
}

$id = $categoryRepository->create($name);

header('Content-Type: application/json');

echo json_encode($id);