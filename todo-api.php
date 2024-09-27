<?php

header("Content-Type: application/json");


function write_log($action, $data) {
    $log = fopen('log.txt', 'a');
    $timestamp = date('Y-m-d H:i:s');
    fwrite($log, "$timestamp - $action: " . json_encode($data) . "\n");
    fclose($log);
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        // Get Todo's (READ)
        $todos = [
            ["id" => "uniqID", "todo" => "First TODO"]
        ];
        echo json_encode($todos);
        write_log("READ", $todos); 
        break;
    case "POST":
        // Add Todo (CREATE)
        $input = json_decode(file_get_contents('php://input'), true); 
        write_log("CREATE", $input);
        break;
    case "PUT":
        // Change Todo (UPDATE)
        $input = json_decode(file_get_contents('php://input'), true); 
        write_log("UPDATE", $input);
        break;
    case "DELETE":
        // Remove Todo (DELETE)
        $input = json_decode(file_get_contents('php://input'), true); 
        write_log("DELETE", $input);
        break;
}

?>
