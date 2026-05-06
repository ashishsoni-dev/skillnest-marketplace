<?php
if (basename($_SERVER['PHP_SELF']) == "db.php") {
    exit("Access denied");
}

$conn = new mysqli("localhost", "root", "", "marketplace_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
