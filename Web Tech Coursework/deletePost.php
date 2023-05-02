<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userEmail'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_POST['postID'])) {
    header('Location: index.php?error=missingPostID');
    exit();
}

// Connect to the database
include('includes/dbh.inc.php');

// Get the post to delete
$postID = mysqli_real_escape_string($conn, $_POST['postID']);
$userEmail = mysqli_real_escape_string($conn, $_SESSION['userEmail']);
$sql = "SELECT * FROM posts WHERE postID = '$postID' AND usersEmail = '$userEmail'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 1) {
    header('Location: index.php?error=postNotFound');
    exit();
}

$row = mysqli_fetch_assoc($result);

// Delete the post
$sql = "DELETE FROM posts WHERE postID = '$postID'";
mysqli_query($conn, $sql);

// Delete the image file, if there is one
if (!empty($row['postImage'])) {
    $imagePath = 'uploads/' . $row['postImage'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

mysqli_close($conn);


header("Location: profile.php?deletePost=success");
exit();
?>