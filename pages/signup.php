<?php
include(__DIR__ . "/partials/header.php");
?>

<div class="auth-page">

  <div class="form-box">

    <h2>Create Account</h2>
    <p class="subtext">Join and start buying or selling services</p>

    <form method="POST" action="../php/signup.php">

      <input type="text" name="name" placeholder="Full Name" required>

      <input type="email" name="email" placeholder="Email Address" required>

      <input type="password" name="password" placeholder="Password" required>

      <select name="role">
        <option value="buyer">Buyer</option>
        <option value="seller">Seller</option>
      </select>

      <button type="submit">Create Account</button>

    </form>

  </div>

</div>

<?php
include(__DIR__ . "/partials/footer.php");
?>