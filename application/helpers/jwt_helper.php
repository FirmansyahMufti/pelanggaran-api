<?php

function validate_jwt() {
    if (!function_exists('getallheaders')) {
        function getallheaders() {
            return $_SERVER;
        }
    }

    $headers = getallheaders();

    if (
        !isset($headers['Authorization']) &&
        !isset($headers['HTTP_AUTHORIZATION'])
    ) {
        echo json_encode(['message' => 'Token tidak ditemukan']);
        exit;
    }

    echo json_encode(['message' => 'JWT MASUK KE HELPER']);
    exit;
}
