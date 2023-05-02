<?php 

if (isset($_POST["submit"])) {
    
    $Fname = $_POST["firstName"];
    $Sname = $_POST["Surname"];
    $email = $_POST["Email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($Fname, $Sname, $email, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit(); 
    }


    



    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidEmail");
        exit(); 
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
            header("location: ../signup.php?error=passwordsdon'tmatch");
            exit(); 
    }

    if (userExists($conn, $email) !== false) {
            header("location: ../signup.php?error=userAlreadyExists");
            exit(); 
    }


    createUser($conn, $Fname, $Sname, $email, $pwd);
}

else{
    header("location: ../signup.php");
    exit();
}