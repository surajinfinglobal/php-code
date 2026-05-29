<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "auth_system";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
  echo '';
} else {
  echo "connection failed: " . mysqli_connect_error();
}

?>