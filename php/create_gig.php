<?php
include("../php/core/init.php");
requireLogin();
requireRole('seller');

$title = trim($_POST['title']);
$desc = trim($_POST['description']);
$price = $_POST['price'];

if (empty($title) || empty($price)) {
    echo "Title and price required";
    exit;
}

if (!is_numeric($price) || $price <= 0) {
    echo "Invalid price";
    exit;
}

$imageTmp = $_FILES['image']['tmp_name'];
$imageName = time() . "_" . $_FILES['image']['name'];

$targetPath = "../uploads/" . $imageName;

// get image info
$info = getimagesize($imageTmp);

if ($info === false) {
    echo "Invalid image";
    exit;
}

$width = $info[0];
$height = $info[1];

// create image from file
if ($info['mime'] == 'image/jpeg') {
    $src = imagecreatefromjpeg($imageTmp);
} elseif ($info['mime'] == 'image/png') {
    $src = imagecreatefrompng($imageTmp);
} else {
    echo "Only JPG/PNG allowed";
    exit;
}

// resize logic
$newWidth = 600;
$newHeight = ($height / $width) * $newWidth;

$dst = imagecreatetruecolor($newWidth, $newHeight);

// preserve PNG transparency
if ($info['mime'] == 'image/png') {
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
}

// resize
imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

// save compressed
if ($info['mime'] == 'image/jpeg') {
    imagejpeg($dst, $targetPath, 75); // quality
} else {
    imagepng($dst, $targetPath, 6); // compression
}

imagedestroy($src);
imagedestroy($dst);

$sql = "INSERT INTO gigs (user_id, title, description, price, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issds", $_SESSION['user_id'], $title, $desc, $price, $imageName);

if ($stmt->execute()) {
    echo "Gig created successfully";
} else {
    echo "Error";
}
