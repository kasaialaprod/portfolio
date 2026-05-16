<?php
header('Content-Type: application/json');

$filePath = __DIR__ . '/../database/links.json';

if (!file_exists($filePath)) {
    file_put_contents($filePath, json_encode([], JSON_PRETTY_PRINT));
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['title']) || empty($input['url'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Données invalides']);
    exit;
}

$links = json_decode(file_get_contents($filePath), true);
if (!is_array($links)) {
    $links = [];
}

$newLink = [
    'id' => uniqid(),
    'title' => trim($input['title']),
    'url' => trim($input['url'])
];

$links[] = $newLink;

file_put_contents($filePath, json_encode($links, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(['success' => true, 'link' => $newLink]);