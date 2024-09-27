<?php
header('Content-Type: application/json');

// Datei, in der die TODOs gespeichert werden
$file = 'todo.json';

// Existierende TODOs laden
if (file_exists($file)) {
    $json_data = file_get_contents($file);
    $todos = json_decode($json_data, true);
} else {
    $todos = [];
}

// Neuen Eintrag hinzufügen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $todos[] = $input['todo'];
    file_put_contents($file, json_encode($todos));
    echo json_encode(['status' => 'success']);
    exit;
}

// TODOs zurückgeben
echo json_encode($todos);
?>
