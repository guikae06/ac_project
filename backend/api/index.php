<?php
header('Content-Type: application/json');
require __DIR__ . '/../config/db.php';

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'GET':
    $stmt = $pdo->query("SELECT * FROM tracker_data ORDER BY timestamp DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['device_id'], $data['temperature'], $data['humidity'])) {
      http_response_code(400);
      echo json_encode(["error" => "Invalid payload"]);
      exit;
    }
    $stmt = $pdo->prepare("INSERT INTO tracker_data (device_id, temperature, humidity) VALUES (?, ?, ?)");
    $stmt->execute([$data['device_id'], $data['temperature'], $data['humidity']]);
    echo json_encode(["success" => true, "id" => $pdo->lastInsertId()]);
    break;

  default:
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}
