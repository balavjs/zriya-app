<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "zriya";

$conn = new mysqli($servername, $username, $password, $dbname);



$sSQL = 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci';

mysqli_query($conn, $sSQL) or die('Can\'t charset in DataBase');



if (!$conn) {
	die("connection failed" . mysqli_error($conn));
} // else// {	// echo "success";// }
