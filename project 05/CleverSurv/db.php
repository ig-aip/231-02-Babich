<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cleversurv_main_bd";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Fialed". mysqli_connect_error());
}?>

