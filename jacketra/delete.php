<?php
require __DIR__ . '/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) exit('Invalid ID');
$stmt = $pdo->prepare('SELECT image FROM products WHERE id = :id');
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();
if (!$product) {
    http_response_code(404);
    exit('Product not found');
}
$stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
$stmt->execute([':id' => $id]);
if ($product['image']) {
    $path = __DIR__ . '/uploads/' . basename($product['image']);
    if (is_file($path)) unlink($path);
}
header('Location: index.php?deleted=1');
exit;