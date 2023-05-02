<?php
    include_once 'header.php';
?>


<section class="signup-form">
    <h2> Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="firstName" placeholder="First Name">
        <input type="text" name="Surname" placeholder="Surname">
        <input type="text" name="Email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwdRepeat" placeholder="Repeat Password">
        <button type="submit" name="submit">Sign Up</button>

    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Please Complete All Fields!</p>";
    }



    
    else if ($_GET["error"] == "invalidEmail") {
        echo "<p>Please enter a valid emnail address</p>";
    }

    else if ($_GET["error"] == "passwordsdon'tmatch") {
        echo "<p>Passwords do not match, please enter matching passwords</p>";
    }

    else if ($_GET["error"] == "userAlreadyExists") {
        echo "<p>A user with this email already exists please login or create an account using a different email address</p>";
    }

    else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, please try again!</p>";
    }

    else if ($_GET["error"] == "none") {
        echo "<p>Your Sign Up was Successful</p>";
    }
}
?>
</section>



<?php
    include_once 'footer.php';
?>

