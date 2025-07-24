<?php
// api.php - Server-side API endpoint for n8n integration
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the request data
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['csv'])) {
            throw new Exception('CSV data is required');
        }
        
        $csvData = $input['csv'];
        $gridSize = isset($input['gridSize']) ? intval($input['gridSize']) : 15;
        
        // Validate grid size
        if ($gridSize < 5 || $gridSize > 30) {
            $gridSize = 15;
        }
        
        // Return success response with instructions
        echo json_encode([
            'success' => true,
            'message' => 'API endpoint working. For full integration, please implement server-side PDF generation or use browser automation.',
            'csvData' => $csvData,
            'gridSize' => $gridSize,
            'wordCount' => substr_count($csvData, ',') + 1,
            'nextSteps' => '1. Use the CSV data in your browser-based generator 2. Generate puzzles manually 3. Export to PDF'
        ]);
        
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method not allowed. Use POST.'
    ]);
}
?>
