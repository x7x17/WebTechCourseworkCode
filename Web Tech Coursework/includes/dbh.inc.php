<!-- database handler -->

<?php

//connections to be used for Local Host XAMMP server

$serverName = "localhost";

$dbUsername = "root";

$dbPassword = "";

$dbName = "twitcherdb";

//connections to be used for Keele W/:drive server

//$serverName = "katara.scam.keele.ac.uk";
//$dbUsername = "x7x17";
//$dbPassword = "x7x17x7x17";
//$dbName = "x7x17";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}

?>