<?php
// Use this script to generate a hashed password for a new admin user.
// You can then insert this hash into the `admin` table.
if (isset($_GET['password'])) {
    $password = $_GET['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo "Hashed password: " . $hashed_password;
} else {
    echo "Please provide a password to hash in the URL. Example: hash_password.php?password=your_password";
}
?>
