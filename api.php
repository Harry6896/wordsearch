<?php
// api.php - Server-side API endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Return a simple response indicating the endpoint works
    echo json_encode([
        'success' => true,
        'message' => 'API endpoint is working. Please use the browser-based API.',
        'endpoint' => 'Use JavaScript API: window.apiEndpoint({csv: "your,csv,data", gridSize: 15})'
    ]);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
}
?>
