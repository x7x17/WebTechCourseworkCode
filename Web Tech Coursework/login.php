<?php
    include_once 'header.php';
?>

<div>
<section class="login-form">
        <h2> Login</h2>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="Email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Login</button>



        </form>
        <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Please Complete All Fields!</p>";
    }

    else if ($_GET["error"] == "wronglogin") {
        echo "<p>Please enter a different Username or Password</p>";
    }
}
?>
</section>




</div>

<?php
    include_once 'footer.php';
?>