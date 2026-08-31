<?php
require __DIR__ . '/database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
// $id = $_GET['id'];
if (!$id) exit('Invalid product ID');
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();
if (!$product) {
    http_response_code(404);
    exit('Product not found');
}
require __DIR__ . '/header.php';
?>
<div class="container">
<h1>Edit Product</h1>
<form method="POST" action="update.php" enctype="multipart/form-data" class="card p-4 bg-light">
  <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
  <div class="mt-2 mb-3">
    <label> Name </label>
  <input name="name" class="form-control "
         value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>

    <div class="mt-2 mb-3">
    <label> description </label>
  <textarea name="description" class="form-control mb-3"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
  </div>
    <div class="row">
      <div class="col-6">
            <label > price </label>
            <input type="number" step="0.01" name="price" class="form-control mb-3"
                value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <div class=" col-6">
            <label > stock </label>
            <input type="number" name="stock" class="form-control mb-3"
                value="<?= (int) $product['stock'] ?>" required>
        </div>
    </div>
    <?php if ($product['image']): ?>
    <img src="uploads/<?= htmlspecialchars($product['image']) ?>"
         width="150" class="mb-3 d-block" alt="">
  <?php endif; ?>
  <input type="file" name="image" class="form-control mb-3">
  <button class="btn btn-dark">Update Product</button>
</form>
  </div>