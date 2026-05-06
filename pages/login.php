<?php
include(__DIR__ . "/partials/header.php");
include("../php/core/init.php");
?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert error">
        <?php echo e($_GET['error']); ?>
    </div>
<?php endif; ?>

<div class="auth-page">

    <div class="form-box">
        <h2>Login</h2>
        <p class="subtext">Welcome back! Please login to continue</p>

        <form method="POST" action="../php/login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</div>

<?php
include(__DIR__ . "/partials/footer.php");
?>