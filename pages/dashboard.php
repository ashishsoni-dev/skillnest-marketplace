<?php
include(__DIR__ . "/partials/header.php");

include("../php/core/init.php");


requireLogin();
?>

<div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Dashboard</h3>

        <?php if ($_SESSION['role'] === 'seller'): ?>
            <a href="my_gigs.php">My Gigs</a>
            <a href="seller_orders.php">Orders</a>
        <?php else: ?>
            <a href="my_orders.php">My Orders</a>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <div class="main">

        <h2>Welcome <?php echo e($_SESSION['name']); ?></h2>

        <?php if ($_SESSION['role'] === 'seller'): ?>

            <h3>Your Gigs</h3>

            <?php
            $sql = "SELECT * FROM gigs WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $gigs = $stmt->get_result();

            while ($row = $gigs->fetch_assoc()) {
                echo "<div class='list-item'>";
                echo "<strong>" . e($row['title']) . "</strong>";
                echo "<p class='price'>₹" . $row['price'] . "</p>";
                echo "</div>";
            }
            ?>

            <h3>Orders Received</h3>

            <?php
            $sql = "SELECT orders.*, gigs.title, gigs.price 
                    FROM orders 
                    JOIN gigs ON orders.gig_id = gigs.id 
                    WHERE orders.seller_id = ?
                    ORDER BY orders.id DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $orders = $stmt->get_result();

            while ($row = $orders->fetch_assoc()) {
                echo "<div class='list-item'>";

                echo "<div class='order-top'>";
                echo "<strong>" . e($row['title']) . "</strong>";
                echo "<span class='status'>" . $row['status'] . "</span>";
                echo "</div>";

                echo "<p class='price'>₹" . $row['price'] . "</p>";
                echo "<p class='meta'>Order #" . $row['id'] . "</p>";

                echo "</div>";
            }
            ?>

        <?php else: ?>

            <h3>Your Orders</h3>

            <?php
            $sql = "SELECT orders.*, gigs.title, gigs.price 
                    FROM orders 
                    JOIN gigs ON orders.gig_id = gigs.id 
                    WHERE orders.buyer_id = ?
                    ORDER BY orders.id DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $orders = $stmt->get_result();

            while ($row = $orders->fetch_assoc()) {
                echo "<div class='list-item'>";

                echo "<div class='order-top'>";
                echo "<strong>" . e($row['title']) . "</strong>";
                echo "<span class='status'>" . $row['status'] . "</span>";
                echo "</div>";

                echo "<p class='price'>₹" . $row['price'] . "</p>";
                echo "<p class='meta'>Order #" . $row['id'] . "</p>";

                echo "</div>";
            }
            ?>

        <?php endif; ?>

    </div>
</div>