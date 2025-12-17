<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if ($data) {
        // Guardar en biblia_progress.json
        $result = file_put_contents('biblia_progress.json', json_encode($data, JSON_PRETTY_PRINT));
        
        if ($result !== false) {
            echo json_encode(['success' => true, 'message' => 'Progreso guardado']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al guardar']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'JSON inválido']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
