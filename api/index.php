<?php

$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

if (($_GET['__debug'] ?? null) === '1') {
    header('Content-Type: application/json');
    echo json_encode($_SERVER);
    exit;
}

require __DIR__ . '/../public/index.php';