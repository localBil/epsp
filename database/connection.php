<?php
require_once(__DIR__ . '/../config.php');

// creaition connexion 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// verifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
