<?php
session_start();
require_once __DIR__ . '/../../../database/db.php';

// optionnel : protection admin
//if (!isset($_SESSION['admin_id'])) {
//    http_response_code(401);
//    echo json_encode(['error' => 'Unauthorized']);
  //  exit;
//}

header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$title = trim($data['title'] ?? '');
$url   = trim($data['url'] ?? '');
$tech  = trim($data['tech'] ?? '');

if ($title === '' || $url === '' || $tech === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO projects (tech, title, url)
        VALUES (:tech, :title, :url)
    ");
    $stmt->execute([
        ':tech'  => $tech,
        ':title' => $title,
        ':url'   => $url,
    ]);

    $id = $pdo->lastInsertId();

    http_response_code(201);
    echo json_encode([
        'id'    => (int)$id,
        'tech'  => $tech,
        'title' => $title,
        'url'   => $url,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB error', 'details' => $e->getMessage()]);
}
