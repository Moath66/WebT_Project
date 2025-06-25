<?php
// Allow all origins — you can restrict this later to specific domains
header("Access-Control-Allow-Origin: *");

// Allow headers needed by your Vue app and Postman
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Allow methods used in RESTful API
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Return response as JSON
header("Content-Type: application/json");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
?>
