<?php
include("../php/core/init.php");
requireLogin();



$search = $_GET['search'] ?? "";

$sql = "SELECT 
            gigs.*, 
            users.name, 
            AVG(reviews.rating) as avg_rating,
            COUNT(reviews.id) as total_reviews
        FROM gigs
        JOIN users ON gigs.user_id = users.id
        LEFT JOIN reviews ON gigs.id = reviews.gig_id
        WHERE gigs.title LIKE ?
        GROUP BY gigs.id
        ORDER BY gigs.id DESC";


$stmt = $conn->prepare($sql);

$searchTerm = "%" . $search . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='empty'>
            <p>No gigs found 😕</p>
            <span>Try different keywords</span>
          </div>";
    exit;
}

while ($row = $result->fetch_assoc()) {

    $rating = $row['avg_rating'] ? round($row['avg_rating'], 1) : null;

    $stars = "";
    if ($rating) {
        $full = floor($rating);
        for ($i = 0; $i < $full; $i++) $stars .= "★";
        for ($i = $full; $i < 5; $i++) $stars .= "☆";
    }

    echo "<div class='card'>";

    echo "<img src='../uploads/" . e($row['image']) . "'>";

    echo "<div class='card-body'>";

    echo "<h3>" . e($row['title']) . "</h3>";

    echo "<p class='meta'>By " . e($row['name']) . "</p>";

    echo "<p class='price'>₹" . $row['price'] . "</p>";

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
