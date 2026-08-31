<?php
require __DIR__ . '/database.php';
$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price = $_POST['price'] ?? null;
$stock = $_POST['stock'] ?? null;
$errors = [];
if ($name === '') $errors[] = 'Name is required';
if (!is_numeric($price) || $price < 0) $errors[] = 'Invalid price';
if (filter_var($stock, FILTER_VALIDATE_INT) === false || $stock < 0) {
    $errors[] = 'Invalid stock';
}
$imageName = null;
$file = $_FILES['image'] ?? null;

if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Image upload failed';
    } else {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];
        if (!isset($allowed[$mime])) {
            $errors[] = 'Image must be JPG, PNG or WebP';
        } elseif ($file['size'] > 2 * 1024 * 1024) {
            $errors[] = 'Image must be 2 MB or smaller';
        } else {
            $imageName = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
        }
    }
}
if ($errors) {
    foreach ($errors as $error) echo htmlspecialchars($error) . '<br>';
    exit;
}
if ($imageName) {
    $uploadDir = __DIR__ . '/uploads';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $imageName);
}
$stmt = $pdo->prepare(
    'INSERT INTO products (name, description, price, stock, image)
     VALUES (:name, :description, :price, :stock, :image)'
);
$stmt->execute([
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':stock' => $stock,
    ':image' => $imageName,
]);
header('Location: index.php?created=1');
exit;

// $file = [
// 'name' => 'omar',
// 'size' => '5',
// 'tmp_name' => 'omaasdasdasdsadr',
// 'error' => 'UPLOAD_ERR_NO_FILE',
// ]
// $file['error']
