<?php
session_start();
require_once 'src/StorageInterface.php';
require_once 'src/SessionStorage.php';
require_once 'src/Cart.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => ['id' => 1, 'name' => 'Clavier Mécanique', 'price' => 120],
    2 => ['id' => 2, 'name' => 'Souris Sans Fil', 'price' => 55],
    3 => ['id' => 3, 'name' => 'Casque Audio', 'price' => 180],
];

if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    if (isset($products[$id])) {
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'name' => $products[$id]['name'],
                'price' => $products[$id]['price'],
                'qty' => 0
            ];
        }
        $_SESSION['cart'][$id]['qty']++;
    }
    header("Location: index.php");
    exit;
}

if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php");
    exit;
}

$totalArticles = array_sum(array_column($_SESSION['cart'], 'qty'));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique PHP - TP Maintenance</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #eef2ff;}
        .product { background: #fff; padding: 15px; margin-bottom: 10px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .btn { padding: 8px 14px; background: #0f766e; color: #fff; text-decoration: none; border-radius: 6px; }
        .btn-danger { background: #dc2626; }
        .btn:hover { background: #115e59; }
        .product:hover { border-color: #0f766e; }
        footer { margin-top: 40px; padding-top: 15px; border-top: 1px solid #cbd5e1; color: #475569; font-size: 14px; }
    </style>
</head>
<footer>
    <p>TP Maintenance Logicielle &amp; Git — Boutique E-Commerce PHP</p>
</footer>
<body>
    <h1>Ma Boutique E-Commerce</h1>
    <h2>Produits disponibles</h2>
    <?php foreach ($products as $p): ?>
        <div class="product">
            <strong><?= htmlspecialchars($p['name']) ?></strong> — <?= $p['price'] ?> DT
            <a href="?add=<?= $p['id'] ?>" class="btn">Ajouter au panier</a>
        </div>
    <?php endforeach; ?>

    <h2>Panier (<?= $totalArticles ?> articles)</h2>
    <pre><?php print_r($_SESSION['cart']); ?></pre>
    <a href="?clear=1" class="btn btn-danger">Vider le panier</a>
</body>
</html>