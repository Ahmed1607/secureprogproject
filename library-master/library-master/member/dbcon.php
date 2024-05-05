<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "mis";
$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}