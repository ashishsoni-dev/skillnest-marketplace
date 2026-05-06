<?php
include(__DIR__ . "/partials/header.php");
include("../php/core/init.php");

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    echo "Invalid gig";
    exit;
}

$sql = "SELECT gigs.*, users.name, 
        AVG(reviews.rating) as avg_rating,
        COUNT(reviews.id) as total_reviews
        FROM gigs
        JOIN users ON gigs.user_id = users.id
        LEFT JOIN reviews ON gigs.id = reviews.gig_id
        WHERE gigs.id = ?
        GROUP BY gigs.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$gig = $stmt->get_result()->fetch_assoc();

if (!$gig) {
    echo "Gig not found";
    exit;
}

$rating = $gig['avg_rating'] ? round($gig['avg_rating'], 1) : null;

$stars = "";
if ($rating) {
    $full = floor($rating);
    for ($i = 0; $i < $full; $i++) $stars .= "★";
    for ($i = $full; $i < 5; $i++) $stars .= "☆";
}
?>

<div class="container">

    <div class="gig-detail">

        <img src="../uploads/<?php echo e($gig['image']); ?>">

        <div class="gig-info">

            <h2><?php echo e($gig['title']); ?></h2>

            <p class="meta">By <?php echo e($gig['name']); ?></p>

            <p class="rating">
                <?php
                if ($rating) {
                    echo $stars . " (" . $rating . " • " . $gig['total_reviews'] . " reviews)";
                } else {
                    echo "No reviews yet";
                }
                ?>
            </p>

            <p class="price">₹<?php echo $gig['price']; ?></p>

            <p><?php echo e($gig['description']); ?></p>

            <?php if (
                isset($_SESSION['user_id']) &&
                $_SESSION['user_id'] != $gig['user_id']
            ): ?>

                <a href="../php/place_order.php?gig_id=<?php echo $gig['id']; ?>" class="btn">
                    Buy Now
                </a>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php include(__DIR__ . "/partials/footer.php"); ?>