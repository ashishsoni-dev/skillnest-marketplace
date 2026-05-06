<?php
include(__DIR__ . "/partials/header.php");
include("../php/core/init.php");
requireLogin();
requireRole('seller');

$seller_id = $_SESSION['user_id'];

$sql = "SELECT orders.*, gigs.title, gigs.price 
        FROM orders 
        JOIN gigs ON orders.gig_id = gigs.id 
        WHERE orders.seller_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $seller_id);
$stmt->execute();

$result = $stmt->get_result();

echo "<div class='container'>";
echo "<h2 class='section-title'>Orders Received</h2>";
echo "<div class='list'>";

while ($row = $result->fetch_assoc()) {

    echo "<div class='list-item'>";
?>

    <?php if ($row['status'] === 'pending'): ?>

        <form method="POST" action="../php/update_order.php" style="margin-top:10px;">
            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
            <button class="btn-complete">Mark as Completed</button>
        </form>

    <?php endif; ?>

<?php
    echo "<div class='order-top'>";
    echo "<strong>" . e($row['title']) . "</strong>";
    echo "<span class='status'>" . $row['status'] . "</span>";
    echo "</div>";

    echo "<p class='price'>₹" . $row['price'] . "</p>";

    echo "<p class='meta'>Order #" . $row['id'] . "</p>";

    echo "<p class='meta'>Placed on: " . date('d M Y', strtotime($row['created_at'])) . "</p>";

    echo "</div>";
}
echo "</div>";
echo "</div>";

include(__DIR__ . "/partials/footer.php");
?>