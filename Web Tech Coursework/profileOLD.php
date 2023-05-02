<?php
    include_once 'header.php';

    
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <style>
    /* Body styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
}

/* Header styles */
header {
  background-color: #333;
  color: #fff;
  padding: 20px;
}

/* User info section styles */
.user-info {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.user-info img {
  max-width: 200px;
  border-radius: 50%;
  margin-bottom: 10px;
}

.user-info h1 {
  font-size: 2rem;
  margin-bottom: 5px;
}

.user-info p {
  font-size: 1.2rem;
  text-align: center;
}

/* User posts section styles */
.user-posts {
  padding: 20px;
}

.user-posts h2 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

.user-posts ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.user-posts li {
  margin-bottom: 10px;
}

/* Footer styles */
/*footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
} */
  </style>
</head>

<header>
    <!-- Header content goes here --> <h1> PROFILE</h1>
  </header>

  <main>


    <section class="user-info">
      <!-- User information goes here, such as profile picture, username, bio, etc. -->
      <h3> <?php echo $_SESSION["userEmail"] ?></h3>
      


    </section>


    <section align="center">
      <div class="col-md-6 offset-3">
        <form action="userProfileUpdate.php"
              method="POST"
              enctype="multipart/form-data"
        >
          <?php
            include('includes/dbh.inc.php');

            $currentUser = $_SESSION['userEmail'];
            $sql = "SELECT * FROM users WHERE usersEmail = '$currentUser'";

            $results = mysqli_query($conn, $sql);

          if($results){
              if(mysqli_num_rows($results) > 0){
                  while($row = mysqli_fetch_array($results)){
                    //print_r($row['usersEmail']);

                  }
                    ?>

          
          <?php
              
          $currentUser = $_SESSION["userEmail"];

          $sql = "SELECT * FROM profiles WHERE usersEmail=?";

          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {

          header("Location: index.php?error=sqlerror");

          exit();

         } else {

           mysqli_stmt_bind_param($stmt, "s", $currentUser);

           mysqli_stmt_execute($stmt);

           $result = mysqli_stmt_get_result($stmt);

           if ($row = mysqli_fetch_assoc($result)) {

           echo "<div class='container'>";

           echo "<div class='card my-5'>";

           echo "<div class='card-body'>";

           echo "<h2 class='card-title'>Your Profile</h2>";


           echo "<p class='card-text'>Biography: " . $row['profilesBio'] . "</p>";

           echo "<p class='card-text'>Mobile Number: " . $row['profilesMobile'] . "</p>";

           echo "<p class='card-text'>Instagram Tag: " . $row['profilesInstagramTag'] . "</p>";

           echo "</div></div></div>";

           }

          ?>

                  


                  <div class="form-group">
                            <input type="text" name="updateUserBio" value="" placeholder="Tell us abit about yourself" class="form-control">
                        
                      
                          <div class="form-group">
                          <input type="text" name="UserMobile" value="" placeholder="Update your mobile phone number"class="form-control">
                          </div>

                          <div class="form-group">
                          <input type="text" name="UserInstagramTag" value="" placeholder="Update your instagram Tag" class="form-control">
                          </div>

                          <div class="form-group">
                          <input type="submit" name="update" value="update" class="btn btn-info">
                          </div>

                    <?php

                    
                  }
                    

                  }
          }

          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Please Complete All Fields!</p>";
        }
      }
          ?>

          
        </form>
      </div>
    </section>
  

    <section class="user-posts">

    <h2> Your Posts</h2>

        <?php

            // Connect to the database
        include('includes/dbh.inc.php');

        // Get the current user's email from the session
        $userEmail = $_SESSION['userEmail'];

        // Get all posts made by the current user from the database
        $sql = "SELECT * FROM posts WHERE usersEmail = '$userEmail' ORDER BY postID DESC";
        $result = mysqli_query($conn, $sql);

        // Check if any posts were found
        if (mysqli_num_rows($result) > 0) {
            // Loop through each post and display it
            while ($row = mysqli_fetch_assoc($result)) {
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

      <!-- User's posts or activity history goes here -->
    </section>
  </main>

</body>
</html>

<?php
    include_once 'footer.php';
?>
