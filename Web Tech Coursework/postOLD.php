<?php
session_start();

if (!isset($_SESSION["userEmail"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postContent = $_POST["postContent"];

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
                $postContent = mysqli_real_escape_string($conn, $postContent);
                $sql = "INSERT INTO posts (postText, usersEmail, postImage) VALUES ('$postContent', '$userEmail')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
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
