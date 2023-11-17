<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "epsp";
// creaition connexion 
$conn = mysqli_connect($servername, $username, $password, $database);

// verifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
