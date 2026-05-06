<?php

include(__DIR__ . "/partials/header.php");

include("../php/core/init.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller') {
    echo "Access denied";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM gigs WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<div class="page">
    <h2 class="section-title">My Gigs</h2>

    <div class="grid">

        <?php
        while ($row = $result->fetch_assoc()) {

            echo "<div class='card'>";

            echo "<img loading='lazy' src='../uploads/" . e($row['image']) . "'>";

            echo "<div class='card-body'>";

            echo "<h3>" . e($row['title']) . "</h3>";

            echo "<p class='price'>₹" . $row['price'] . "</p>";

            echo "<p class='meta'>Active Gig</p>";

            echo "<a href='gig.php?id=" . $row['id'] . "' class='btn'>View Gig</a>";

            echo "</div>";

            echo "</div>";
        }
        ?>

    </div>
</div>


<?php
include(__DIR__ . "/partials/footer.php");
?>