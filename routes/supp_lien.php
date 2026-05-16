<?php
header('Content-Type: application/json');

$filePath = __DIR__ . '/../database/links.json';

if (!file_exists($filePath)) {
    file_put_contents($filePath, json_encode([], JSON_PRETTY_PRINT));
}

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'ID manquant']);
    exit;
}

$links = json_decode(file_get_contents($filePath), true);
if (!is_array($links)) {
    $links = [];
}

$filtered = array_values(array_filter($links, function ($link) use ($id) {
    return $link['id'] !== $id;
}));

file_put_contents($filePath, json_encode($filtered, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(['success' => true]);