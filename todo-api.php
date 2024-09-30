<?php

header("Content-Type: application/json");
// Setzt den Header der HTTP-Antwort auf "application/json", um dem Client mitzuteilen, dass die Antwort JSON-Daten enthält.

// LOG function in PHP
function write_log($action, $data) {
    // Funktion zum Schreiben von Logs. Sie nimmt eine Aktion und Daten entgegen.
    $log = fopen('log.txt', 'a');
    // Öffnet oder erstellt die Datei 'log.txt' im Anhänge-Modus ('a'), sodass neue Einträge ans Ende hinzugefügt werden.
    $timestamp = date('Y-m-d H:i:s');
    // Erstellt einen Zeitstempel mit dem aktuellen Datum und der Uhrzeit im Format 'Jahr-Monat-Tag Stunde:Minute:Sekunde'.
    fwrite($log, "$timestamp - $action: " . json_encode($data) . "\n");
    // Schreibt den Zeitstempel, die Aktion und die JSON-codierten Daten in die Log-Datei.
    fclose($log);
    // Schließt die geöffnete Log-Datei, um Speicherressourcen freizugeben.
}

// Read content of the file and decode JSON data to an array.
$todo_file = 'todos.json';
// Speichert den Dateipfad der JSON-Datei, die die Todo-Elemente enthält.
$todo_items = json_decode(file_get_contents($todo_file), true);
// Liest den Inhalt der 'todos.json'-Datei und wandelt die JSON-Daten in ein PHP-Array um.

// Überprüft die HTTP-Anfragemethode (GET, POST, PUT oder DELETE).
switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        // GET-Anfrage (READ) - Gibt die vorhandenen Todo-Elemente zurück.
        echo json_encode($todo_items);
        // Sendet die Todo-Elemente als JSON-codierte Antwort zurück.
        write_log("READ", $todo_items);
        // Schreibt den "READ"-Vorgang und die gelesenen Daten in die Log-Datei.
        break;
    case "POST":
        // POST-Anfrage (CREATE) - Fügt ein neues Todo-Element hinzu.
        
        // Liest den JSON-Input-Stream, der die Daten der POST-Anfrage enthält.
        $input = file_get_contents('php://input');
        // Wandelt den Input-Stream in ein PHP-Array um.
        $data = json_decode($input, true);
        
        // Erstellt ein neues Todo-Element mit einer eindeutigen ID und dem übergebenen Titel.
        $new_todo = ["id" => uniqid(), "title" => $data['title']];
        // Fügt das neue Todo-Element dem Array der Todo-Items hinzu.
        $todo_items[] = $new_todo;
        
        // Schreibt das aktualisierte Todo-Array zurück in die JSON-Datei.
        file_put_contents($todo_file, json_encode($todo_items));
        
        // Gibt das neu erstellte Todo-Element als JSON-Antwort zurück.
        echo json_encode($new_todo);
        // Schreibt den "CREATE"-Vorgang und das erstellte Element in die Log-Datei.
        write_log("CREATE", $new_todo);
        break;
    case "PUT":
        // PUT-Anfrage (UPDATE) - Aktualisiert ein bestehendes Todo-Element (nicht implementiert).
        write_log("PUT", null);
        // Schreibt den "PUT"-Vorgang in die Log-Datei (ohne weitere Daten, da PUT nicht implementiert ist).
        break;
    case "DELETE":
        // DELETE-Anfrage (DELETE) - Löscht ein bestehendes Todo-Element (nicht implementiert).
        write_log("DELETE", null);
        // Schreibt den "DELETE"-Vorgang in die Log-Datei (ohne weitere Daten, da DELETE nicht implementiert ist).
        break;
}

?>
