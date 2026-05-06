<?php
include("../php/core/init.php");
requireLogin();
requireRole('buyer');

$gig_id = $_GET['gig_id'];

if (!is_numeric($gig_id)) {
    echo "Invalid request";
    exit;
}

$buyer_id = $_SESSION['user_id'];

// get seller_id from gig
$sql = "SELECT user_id FROM gigs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $gig_id);
$stmt->execute();
$result = $stmt->get_result();
$gig = $result->fetch_assoc();

if (!$gig) {
    echo "Gig not found";
    exit;
}

$seller_id = $gig['user_id'];

$sql = "INSERT INTO orders (gig_id, buyer_id, seller_id, status)
        VALUES (?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $gig_id, $buyer_id, $seller_id);

if ($stmt->execute()) {
    header("Location: ../pages/my_orders.php");
    exit;
} else {
    echo "Error";
}
