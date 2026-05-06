<?php
include("core/init.php");
requireLogin();
requireRole('seller');

$order_id = $_POST['order_id'];
$seller_id = $_SESSION['user_id'];

// security: only seller can update their order
$sql = "UPDATE orders SET status='completed' 
        WHERE id=? AND seller_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $order_id, $seller_id);
$stmt->execute();

header("Location: ../pages/seller_orders.php");
exit;
