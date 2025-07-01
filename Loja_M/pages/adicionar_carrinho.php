<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Faça login primeiro']);
    exit;
}

if(!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$id = $_GET['id'];
$_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1;

echo json_encode([
    'success' => true,
    'totalItems' => array_sum($_SESSION['carrinho'])
]);
?>