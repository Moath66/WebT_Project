<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$request_uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('/', trim($request_uri, '/'));

// Remove 'api' from the path
array_shift($uri_parts);

// Get the resource and ID
$resource = $uri_parts[0] ?? '';
$id = $uri_parts[1] ?? null;

// Route the request
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($resource === 'transactions') {
            require_once 'transactions/get.php';
        }
        break;
    
    case 'POST':
        if ($resource === 'transactions') {
            require_once 'transactions/post.php';
        }
        break;
    
    case 'PUT':
        if ($resource === 'transactions' && $id) {
            require_once 'transactions/put.php';
        }
        break;
    
    case 'DELETE':
        if ($resource === 'transactions' && $id) {
            require_once 'transactions/delete.php';
        }
        break;
    
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
        break;
}
?> 