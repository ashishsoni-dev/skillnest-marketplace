<?php
include("pages/partials/header.php");
include("php/core/init.php");
requireLogin();
?>

<div class="page">

    <h2 class="section-title">Welcome <?php echo e($_SESSION['name']); ?></h2>

    <div class="grid">

        <div class="card action-card">
            <h3>Browse Gigs</h3>
            <p>Explore services from sellers</p>
            <a href="pages/browse.php" class="btn">Explore</a>
        </div>

        <div class="card action-card">
            <h3>My Orders</h3>
            <p>Track your purchases</p>
            <a href="pages/my_orders.php" class="btn">View Orders</a>
        </div>

        <?php if ($_SESSION['role'] === 'seller'): ?>

            <div class="card action-card">
                <h3>Create Gig</h3>
                <p>Start selling your service</p>
                <a href="pages/create_gig.php" class="btn">Create</a>
            </div>

            <div class="card action-card">
                <h3>My Gigs</h3>
                <p>Manage your listings</p>
                <a href="pages/my_gigs.php" class="btn">Manage</a>
            </div>

            <div class="card action-card">
                <h3>Seller Orders</h3>
                <p>View incoming orders</p>
                <a href="pages/seller_orders.php" class="btn">View</a>
            </div>

        <?php endif; ?>

    </div>

</div>


<?php
include("pages/partials/footer.php");
?>