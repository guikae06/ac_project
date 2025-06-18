<?php
$host = getenv('POSTGRES_HOST') ?: 'db';
$db   = getenv('POSTGRES_DB') ?: 'webtech';
$user = getenv('POSTGRES_USER') ?: 'webuser';
$pass = getenv('POSTGRES_PASSWORD') ?: 'secret';
$dsn = "pgsql:host=$host;dbname=$db";

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["error" => $e->getMessage()]);
  exit;
}
