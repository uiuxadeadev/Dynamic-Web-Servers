<?php
// Set HTTP header to specify JSON response
header('Content-Type: application/json');

// Set download file name
$filename = 'request_headers_' . date('Y-m-d_H-i-s') . '.json';
header(sprintf('Content-Disposition: attachment; filename="%s"', $filename));

// Get current timestamp
$timestamp = date('c');

// Create response data structure
$response = [
    'timestamp' => $timestamp,
    'request' => [
        'headers' => getallheaders() ?? [],
        'method' => $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN',
        'path' => $_SERVER['REQUEST_URI'] ?? '/',
        'query_params' => $_GET,
    ],
    'server' => [
        'software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown Server',
        'protocol' => $_SERVER['SERVER_PROTOCOL'] ?? 'Unknown Protocol',
        'host' => $_SERVER['HTTP_HOST'] ?? 'localhost',
    ]
];

// Encode and output as JSON
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);