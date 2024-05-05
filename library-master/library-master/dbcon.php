<?php
$server = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "mis";
$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}