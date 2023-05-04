<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

if (isset($_POST['update'])) {

    $userNewBio = $_POST['updateUserBio'];
    $userMobile = $_POST['UserMobile'];
    $userInstagramTag = $_POST['UserInstagramTag'];
    $userEmail = $_SESSION["userEmail"];

    if (empty($userNewBio) | empty($userMobile) | empty($userInstagramTag)) {
        header("location: ../profile.php?error=emptyinput");
        exit(); 
    } 
   


       // Connect to database
       include('includes/dbh.inc.php');

       //Update user information in the database
       //$sql = "UPDATE profiles
       //SET profilesBio = '$userNewBio', profilesMobile = '$userMobile', profilesInstagramTag = '$userInstagramTag'
       //WHERE usersEmail = '$userEmail'";

      $sql = "UPDATE profiles
        SET profilesBio = IFNULL('$userNewBio', profilesBio),
           profilesMobile = IFNULL('$userMobile', profilesMobile),
            profilesInstagramTag = IFNULL('$userInstagramTag', profilesInstagramTag)
        WHERE usersEmail = '$userEmail'";


       // Execute SQL statement and check for errors
       if(mysqli_query($conn, $sql)){
            //echo "User information updated successfully";
            header("location: ../profile.php?success=profileUpdatedSuccessfully");
       } else{
           echo "Error updating user information: " . mysqli_error($conn);
       }
     
   }
   
   ?>



  


?>


