<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../src/StorageInterface.php';
require_once __DIR__ . '/../src/SessionStorage.php';
require_once __DIR__ . '/../src/Cart.php';

use App\Cart;
use App\SessionStorage;

$products = require_once __DIR__ . '/datastore.php';
$storage = new SessionStorage();
$cart = new Cart($storage);