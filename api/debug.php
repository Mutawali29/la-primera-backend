<?php
header('Content-Type: application/json');
echo json_encode([
    'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? null,
    'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'] ?? null,
    'PATH_INFO' => $_SERVER['PATH_INFO'] ?? null,
    'PHP_SELF' => $_SERVER['PHP_SELF'] ?? null,
]);