<?php
$servername = "db";
$username = "user";
$password = "userpass111";
$dbname = "appDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function set_status($is_successful, $success_code, $failure_code) {
    http_response_code($is_successful ? $success_code : $failure_code);
}