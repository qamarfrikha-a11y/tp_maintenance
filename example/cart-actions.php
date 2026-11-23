<?php
require_once __DIR__ . '/init.php';

$query = $_GET;
$action = $query['action'] ?? null;
$productId = isset($query['id']) ? (int)$query['id'] : null;
$quantity = isset($query['quantity']) ? (int)$query['quantity'] : 1;

$index = array_search($productId, array_column($products, 'id'));

if (in_array($action, ['add', 'update', 'remove', 'clear'])) {
    switch ($action) {
        case 'add':
            if ($productId && $index !== false) {
                $cart->addItem($products[$index], max(1, $quantity));
            }
            break;
        case 'update':
            if ($productId) {
                $cart->updateItem($productId, max(1, $quantity));
            }
            break;
        case 'remove':
            if ($productId) {
                $cart->removeItem($productId);
            }
            break;
        case 'clear':
            $cart->clearItems();
            break;
    }
    header('Location: cart.php');
    exit;
}


header('Location: index.php');
exit;