<?php
session_start();

if (!isset($_SESSION["userEmail"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postContent = $_POST["postContent"];
    $postImage = $_FILES["image"]["name"];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if (empty($postContent)) {
        $error = "Post content is required.";
    } else {
        include('includes/dbh.inc.php');

        $currentUser = $_SESSION['userEmail'];
        $sql = "SELECT * FROM users WHERE usersEmail = '$currentUser'";

        $results = mysqli_query($conn, $sql);

        if($results){
            if(mysqli_num_rows($results) > 0){
                while($row = mysqli_fetch_array($results)){
                    $userEmail = $row['usersEmail'];
                }

                // Check if the file is a valid image
                if (!in_array($imageFileType, $allowedTypes)) {
                    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                    // Upload the file to the server
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        $postContent = mysqli_real_escape_string($conn, $postContent);
                        $postImage = mysqli_real_escape_string($conn, $postImage);
                        $sql = "INSERT INTO posts (postText, usersEmail, postImage) VALUES ('$postContent', '$userEmail', '$postImage')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: index.php");
                            exit();
                        } else {
                            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        $error = "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                $error = "No user found with email $currentUser.";
            }
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>