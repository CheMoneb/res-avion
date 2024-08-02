<?php

require 'db.php';


$query = "SELECT * FROM reservations";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $errors[] = "Failed to prepare SQL statement.";
}

?>