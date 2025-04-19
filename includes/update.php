<?php
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $id]);
    
    header("Location: ../index.php");
    exit;
}

require_once '../includes/header.php';
?>

<h2>Edit Product</h2>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="../index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php require_once '../includes/footer.php'; ?>