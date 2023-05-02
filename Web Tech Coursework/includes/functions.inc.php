<?php
function emptyInputSignup($Fname, $Sname, $email, $pwd, $pwdRepeat) {
    $result = false;
    if(empty($Fname) || empty($Sname) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
     $result = true; 
    }
    else {
     $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $result = true; 
    }
    else {
     $result = false;
    }
    return $result;
}


function pwdMatch($pwd, $pwdRepeat) {
    $result = false;
    if($pwd !== $pwdRepeat) {
     $result = true; 
    }
    else {
     $result = false;
    }
    return $result;
}

function userExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=error=stmtfailed");
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{


        $result = false;
        return $result; 
        
    }

    mysqli_stmt_close($stmt);
}







function createUser($conn, $Fname, $Sname, $email, $pwd) {
    $userSql = "INSERT INTO users (usersFirstName, usersLastName, usersEmail, usersPwd) VALUES (?, ?, ?, ?)";
    $profileSql = "INSERT INTO profiles (usersEmail) VALUES (?)";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userSql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit(); 
    }


    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $Fname, $Sname, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $profileSql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit(); 
}




function emptyInputLogin($email, $pwd) {
    $result = false;
    if(empty($email) || empty($pwd)) {
     $result = true; 
    }
    else {
     $result = false;
    }
    return $result;
}

function loginUser($conn, $email, $pwd) {
    $userProfileExists = userExists($conn, $email); 

    if ($userProfileExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit(); 
    }

    $pwdHashed = $userProfileExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false ) {
        header("location: ../login.php?error=wronglogin");
        exit(); 
    }
    else if ($checkPwd === true) {
       session_start(); 
       $_SESSION["userid"] =  $userProfileExists["usersId"];  
       $_SESSION["userEmail"] =  $userProfileExists["usersEmail"];
       header("location: ../index.php?error=loginSuccesful");
       exit(); 
    }
  }

