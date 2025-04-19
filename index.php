<?php
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<div class="row mb-4">
    <div class="col-md-6">
        <a href="includes/create.php" class="btn btn-primary">Add New Product</a>
    </div>
    <div class="col-md-6">
        <form action="includes/search.php" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="Search products...">
            <button type="submit" class="btn btn-outline-success">Search</button>
        </form>
    </div>
</div>

<?php
// Display all products by default
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();

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
        echo '<a href="includes/update.php?id=' . $product['id'] . '" class="btn btn-sm btn-warning me-1">Edit</a>';
        echo '<a href="includes/delete.php?id=' . $product['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    
    echo '</tbody></table></div>';
} else {
    echo '<div class="alert alert-info">No products found.</div>';
}

require_once 'includes/footer.php';
?>