<?php

require 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnection</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Se déconnecter</h1>
    
    <form action="deconnection.php" method="post">
        <input type="submit" value="Déconnection">
    </form>
</body>
</html>