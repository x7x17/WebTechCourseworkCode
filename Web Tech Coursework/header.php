<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Twitcher</title>
<style>
    #navBar{

        height: 60px;
        background-color: black;
        color:antiquewhite;
    }

    #searchBox{
     
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 4px;
        font-size: 14px;
        background-image: url(Search.png);
        background-repeat: no-repeat;
        background-position: right;
        position: relative;
        bottom: 5px; 

    }

    #signUp{
        width: 50px; 
        position: relative;
        right: 50px;
        font-size: 30px;
        font-family: tahoma; 
        color:antiquewhite;
        padding: 10px;
    }

    #login{
        width: 50px; 
        position: relative;
        right: 50px; 
        font-size: 30px;
        font-family: tahoma;
        color:antiquewhite;
        padding: 10px;
        
    }

    #profile{
        width: 50px; 
        position: relative;
        right: 50px; 
        font-size: 30px;
        font-family: tahoma;
        color:antiquewhite;
        padding: 10px;
        
    }

    #logout{
        width: 50px; 
        position: relative;
        right: 50px; 
        font-size: 30px;
        font-family: tahoma;
        color:antiquewhite;
        padding: 10px;
    
    }

    #twitcherBird{
        width: 50px;
        position: relative;
        right: 630px;
        bottom: 5px;
        

    }

    #innerNavBar{
        width: 1200px; 
        margin:auto; 
        font-size: 30px;
        position: relative;
        top: 10px;
    }
   
</style>


</head>
<body style="font-family: tahoma;">

    <nav>
        <div id="navBar">
            <div id="innerNavBar">
           Twitcher &nbsp <input type="text" id="searchBox" placeholder="Search">
            <a href="index.php"><img src="uglyBird.png" alt="Twitcher Bird" id=twitcherBird>
            

                <?php
                  if (isset($_SESSION["userEmail"])) 
                  {
                ?>
                    <a href='profile.php' id="profile"> <?php echo $_SESSION["userEmail"] ?></a> 
                    <a href='includes/logout.inc.php' id="logout">LOGOUT</a> 
                <?php  
                }
                  else {
                ?>
                    <a href='signup.php' id="signUp">SIGN UP</a>
                    <a href='login.php' id="login">LOGIN</a>
                <?php
                  }
                ?>
        </div>
</body>      
        
    </nav>  

<div class="wrapper"> 