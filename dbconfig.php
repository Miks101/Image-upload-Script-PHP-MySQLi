<?php
//Fill this information
$host     = "localhost"; // Database Host
$user     = "adultimg_username"; // Database Username
$password = "pasword@"; // Database's user Password
$database = "adultimg_dbname"; // Database Name

//------------------------------------------------------------

$connect = mysqli_connect($host, $user, $password, $database);

// Checking Connection
if (mysqli_connect_errno()) {
    echo "Failed to connect with MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($connect, "utf8");

?>