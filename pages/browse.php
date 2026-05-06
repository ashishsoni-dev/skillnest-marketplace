<?php
include(__DIR__ . "/partials/header.php");

echo "<h2 class='section-title'>Browse Gigs</h2>";
?>

<form class="search-box" onsubmit="return false;">
    <input type="text" id="search" placeholder="Search gigs...">
</form>

<div class="results-wrapper">
    <div id="results" class="grid">

        <?php
        include("../php/core/init.php");

        $search = $_GET['search'] ?? "";
        $min = $_GET['min_price'] ?? 0;
        $max = $_GET['max_price'] ?? 100000;

        $sql = "SELECT 
                gigs.*, 
                users.name,
                AVG(reviews.rating) as avg_rating,
                COUNT(reviews.id) as total_reviews
                FROM gigs
                JOIN users ON gigs.user_id = users.id
                LEFT JOIN reviews ON gigs.id = reviews.gig_id
                GROUP BY gigs.id
                ORDER BY gigs.id DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $rating = $row['avg_rating'] ? round($row['avg_rating'], 1) : null;

                $stars = "";
                if ($rating) {
                    $full = floor($rating);
                    for ($i = 0; $i < $full; $i++) {
                        $stars .= "★";
                    }
                    for ($i = $full; $i < 5; $i++) {
                        $stars .= "☆";
                    }
                }

                echo "<div class='card'>";

                echo "<img src='../uploads/" . $row['image'] . "'>";

                echo "<div class='card-body'>";
                echo "<h3>" . e($row['title']) . "</h3>";
                echo "<p class='price'>₹" . $row['price'] . "</p>";
                echo "<p class='meta'>By " . e($row['name']) . "</p>";


                echo "<p class='rating'>";

                if ($rating) {
                    echo $stars . " <span class='meta'>(" . $rating . " • " . $row['total_reviews'] . " reviews)</span>";
                } else {
                    echo "<span class='meta'>No reviews yet</span>";
                }

                echo "</p>";
                echo "<a href='gig.php?id=" . $row['id'] . "' class='btn'>View</a>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p class='empty'>No gigs found</p>";
        }

        ?>
    </div> <!-- grid -->
</div> <!-- results-wrapper -->

<?php
include(__DIR__ . "/partials/footer.php");
?>

<script defer src="../js/main.js"></script>