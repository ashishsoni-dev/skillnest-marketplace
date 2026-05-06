<?php
include("../php/core/init.php");
requireLogin();
requireRole('buyer');

$order_id = $_POST['order_id'];
$rating = $_POST['rating'];

if ($rating < 1 || $rating > 5) {
    echo "<script>alert('Invalid rating');</script>";
    exit;
}

$comment = $_POST['comment'];
$buyer_id = $_SESSION['user_id'];

$sql = "SELECT id FROM reviews WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();

if ($stmt->get_result()->num_rows > 0) {
    header("Location: ../pages/my_orders.php?success=review_already_submitted");
    exit;
}


// get seller_id and gig_id from order
$sql = "SELECT seller_id, gig_id FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();

$order = $stmt->get_result()->fetch_assoc();

$seller_id = $order['seller_id'];
$gig_id = $order['gig_id'];


// insert review

$sql = "INSERT INTO reviews (order_id, buyer_id, seller_id, gig_id, rating, comment)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiis", $order_id, $buyer_id, $seller_id, $gig_id, $rating, $comment);

if ($stmt->execute()) {
    header("Location: ../pages/my_orders.php?success=review_submitted");
    exit;
} else {
    echo "Error";
}
