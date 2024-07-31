<?php

require 'db.php';

$stmt = $conn->prepare("INSERT INTO users (`username`, `password`, `email`)
VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $email);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $stmt->execute();
}

?>