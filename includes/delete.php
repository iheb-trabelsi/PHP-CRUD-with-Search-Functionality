<?php
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../index.php");
exit;
?>