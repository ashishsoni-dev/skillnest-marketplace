<?php
include(__DIR__ . "/partials/header.php");
include("../php/core/init.php");
requireLogin();
requireRole('buyer');
?>
<div class="form-box">

  <h2 class="section-title review-title">Leave a Review</h2>

  <form action="../php/submit_review.php" method="POST">
    <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>">

    <div class="star-select">
      <span data-value="1">★</span>
      <span data-value="2">★</span>
      <span data-value="3">★</span>
      <span data-value="4">★</span>
      <span data-value="5">★</span>
    </div>

    <input type="hidden" name="rating" id="rating" required>

    <textarea name="comment" placeholder="Write your experience..."></textarea>

    <button type="submit">Submit Review</button>
  </form>

</div>

<?php
include(__DIR__ . "/partials/footer.php");
?>

<script>
  const stars = document.querySelectorAll('.star-select span');
  const input = document.getElementById('rating');

  stars.forEach(star => {
    star.addEventListener('click', () => {
      let val = star.dataset.value;
      input.value = val;

      stars.forEach(s => s.classList.remove('active'));
      for (let i = 0; i < val; i++) {
        stars[i].classList.add('active');
      }
    });
  });
</script>