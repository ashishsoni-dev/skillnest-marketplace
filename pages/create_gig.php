<?php
include(__DIR__ . "/partials/header.php");
include("../php/core/init.php");
requireLogin();
requireRole('seller');
?>

<div class="form-box">

    <h2>Create Gig</h2>

    <form id="gigForm" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="Title" required>

        <textarea name="description" placeholder="Description"></textarea>

        <input type="number" name="price" placeholder="Price" required>

        <input type="file" name="image" required>

        <button type="submit">Create Gig</button>

    </form>

</div>

<?php
include(__DIR__ . "/partials/footer.php");
?>
<script defer src="../js/main.js"></script>