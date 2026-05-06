<?php
include(__DIR__ . "/partials/header.php");
include("../php/core/init.php");
requireLogin();
requireRole('buyer');
?>

<?php if (isset($_GET['success'])): ?>
    <div class="alert success">
        Review submitted successfully!
    </div>
<?php endif; ?>

<?php
$buyer_id = $_SESSION['user_id'];


$sql = "SELECT orders.*, gigs.title, gigs.price, reviews.rating 
        FROM orders 
        JOIN gigs ON orders.gig_id = gigs.id 
        LEFT JOIN reviews ON orders.id = reviews.order_id
        WHERE orders.buyer_id = ?
        ORDER BY orders.id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $buyer_id);
$stmt->execute();

$result = $stmt->get_result();
?>


<div class="page">
    <h2 class="section-title">Your Orders</h2>

    <div class="list">

        <?php
        while ($row = $result->fetch_assoc()) {

            echo "<div class='list-item'>";

            echo "<div class='order-top'>";
            echo "<strong>" . e($row['title']) . "</strong>";
            echo "<span class='status'>" . $row['status'] . "</span>";
            echo "</div>";

            echo "<p class='price'>₹" . $row['price'] . "</p>";

            echo "<p class='meta'>Order #" . $row['id'] . "</p>";

            echo "<p class='meta'>Placed on: " . date('d M Y', strtotime($row['created_at'])) . "</p>";

            if ($row['status'] === 'completed') {

                if ($row['rating']) {
                    echo "<p class='rating'>You rated: " . str_repeat("★", $row['rating']) . "</p>";
                } else {
                    echo "<a href='review.php?order_id=" . $row['id'] . "' class='btn'>Leave Review</a>";
                }
            }

            echo "</div>"; // VERY IMPORTANT
        }
        ?>

    </div>
</div>

<?php
include(__DIR__ . "/partials/footer.php");
?>