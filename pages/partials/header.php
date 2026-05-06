<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Marketplace-app/css/style.css">
</head>

<body>

    <div class="navbar">
        <div class="nav-container">

            <!-- LOGO -->
            <a href="/Marketplace-app/index.php" class="logo">Marketplace</a>

            <div class="nav-links">

                <?php
                $current = basename($_SERVER['PHP_SELF']);
                ?>

                <a href="/Marketplace-app/index.php" class="<?= $current == 'index.php' ? 'active' : '' ?>">Home</a>

                <a href="/Marketplace-app/pages/browse.php" class="<?= $current == 'browse.php' ? 'active' : '' ?>">Browse</a>

                <?php if (isset($_SESSION['user_id'])): ?>

                    <a href="/Marketplace-app/pages/dashboard.php" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>

                    <a href="/Marketplace-app/php/logout.php">Logout</a>

                <?php else: ?>

                    <a href="/Marketplace-app/pages/login.php" class="<?= $current == 'login.php' ? 'active' : '' ?>">Login</a>

                    <a href="/Marketplace-app/pages/signup.php" class="<?= $current == 'signup.php' ? 'active' : '' ?>">Signup</a>

                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="container">