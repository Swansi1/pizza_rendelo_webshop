<?php
// date_default_timezone_set("Europe/Budapest");

$servername = "localhost";
$username = "FELHASZNALO";
$password = "JELSZO";
$dbname = "webterv_acs_zrinyi";

$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>