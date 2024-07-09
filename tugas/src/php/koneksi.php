<?php

$server = "localhost";
$email = "root";
$password = "";

$db = mysqli_connect($server, $email, $password);

try {
    $conn = new PDO("mysql:host=$server;dbname=berita", $email, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>