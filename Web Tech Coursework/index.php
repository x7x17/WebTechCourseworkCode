<?php
    include_once 'header.php';

    
?>

<div>
 <section class="index-intro">
        <?php
            if (isset($_SESSION["userEmail"])) {
                echo "<p> Hello there " . $_SESSION["userEmail"] . " </p>";   
            }
        ?>

        <h1> Welcome to Twitcher the fictional social media site so orginally named </h1>


<h2>Make a Post</h2>
            <form action="post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="image">Choose an image to upload:</label>
             <input type="file" class="form-control-file" id="image" name="image">
            <textarea name="postContent" placeholder="Tell us about your recent spottings?"></textarea>
            <br>
            <button type="submit">Post</button>

        </form>
    </section>
</div>


<div>
<?php

// Connect to the database
include('includes/dbh.inc.php');

// Get all posts from the database
$sql = "SELECT * FROM posts ORDER BY postID DESC";
$result = mysqli_query($conn, $sql);

// Check if any posts were found
if (mysqli_num_rows($result) > 0) {
    // Loop through each user and display their posts
    $currentUser = null;
    while ($row = mysqli_fetch_assoc($result)) {
        // Get the user who made the post
        $userEmail = $row['usersEmail'];
        if ($currentUser !== $userEmail) {
            $userSql = "SELECT * FROM users WHERE usersEmail = '$userEmail'";
            $userResult = mysqli_query($conn, $userSql);
            $user = mysqli_fetch_assoc($userResult);
            // Display the user email
            echo '<p>' . $user['usersEmail'] . '</p>';
            $currentUser = $userEmail;
        }
        // Display the post
        echo '<p class="post-content">' . $row['postText'] . '</p>';

        // Display the image, if there is one
    if (!empty($row['postImage'])) {
        $imagePath = 'uploads/' . $row['postImage'];
        echo '<img src="' . $imagePath . '">';
    }
    }
} else {
    // Display a message if no posts were found
    echo 'No posts found.';
}

// Close the database connection
mysqli_close($conn);
?>

</div>

<?php
    include_once 'footer.php';
?>
