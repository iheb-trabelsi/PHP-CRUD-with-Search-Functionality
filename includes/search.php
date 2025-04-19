<?php
require_once '../config/database.php';
require_once '../includes/header.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!empty($query)) {
    $search = "%$query%";
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY created_at DESC");
    $stmt->execute([$search, $search]);
    $products = $stmt->fetchAll();
} else {
    header("Location: ../index.php");
    exit;
}
?>

<h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>
<a href="../index.php" class="btn btn-secondary mb-3">Back to All Products</a>

<?php
if ($products) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped table-hover">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    
    foreach ($products as $product) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($product['id']) . '</td>';
        echo '<td>' . htmlspecialchars($product['name']) . '</td>';
        echo '<td>' . htmlspecialchars($product['description']) . '</td>';
        echo '<td>' . htmlspecialchars($product['price']) . ' TND</td>';
        echo '<td>';
        echo '<a href="update.php?id=' . $product['id'] . '" class="btn btn-sm btn-warning me-1">Edit</a>';
        echo '<a href="delete.php?id=' . $product['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    
    echo '</tbody></table></div>';
} else {
    echo '<div class="alert alert-info">No products found matching your search.</div>';
}

require_once '../includes/footer.php';
?>