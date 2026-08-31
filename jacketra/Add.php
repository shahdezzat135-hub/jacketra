<?php require __DIR__ . '/header.php'; ?>
<div class="container">
<h1>Add Product</h1>
<form method="POST" action="store.php" enctype="multipart/form-data" class="card p-4 bg-light">
  <div class="mb-3">
    <label class="form-label">Name</label>
  <input name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control"></textarea>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Price</label>
      <input type="number" step="0.01" min="0" name="price" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Stock</label>
      <input type="number" min="0" name="stock" class="form-control" required>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" name="image" accept="image/*" class="form-control">
  </div>
  <button class="btn btn-dark">Save Product</button>
</form>
</div>