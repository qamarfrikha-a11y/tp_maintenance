<?php
require_once __DIR__ . '/init.php';

$query = $_GET;
$action = $query['action'] ?? null;
$productId = isset($query['id']) ? (int)$query['id'] : null;
$quantity = isset($query['quantity']) ? (int)$query['quantity'] : 1;

$index = array_search($productId, array_column($products, 'id'));

if (in_array($action, ['add', 'update', 'remove']) && $productId && $index !== false) {
    $item = $products[$index];

    switch ($action) {
        case 'add':
            $cart->addItem($item, max(1, $quantity));
            break;
        case 'update':
            $cart->updateItem($productId, max(1, $quantity));
            break;
        case 'remove':
            $cart->removeItem($productId);
            break;
    }

    header('Location: cart.php');
    exit;
}

header('Location: index.php');
exit;