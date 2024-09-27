<?php

header("Content-Type: application/json");

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        // Get TODO (Read)
        break;
    case "POST":
        // ADD Todo (CREATE)
        break;
    case "PUT":
        //Change Todo (UPDATE)
        break;
        case "DELETE":
            //REMOVE TODO DELETE
        break;
    
}
?>