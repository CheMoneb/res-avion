<?php
require_once 'db.php';

$term = trim(strip_tags($_GET['term']));

$query = $conn->prepare("SELECT DISTINCT location FROM hotels WHERE location LIKE CONCAT('%', ?, '%') LIMIT 10");
$query->bind_param("s", $term);
$query->execute();
$result = $query->get_result();

$locations = [];
while ($row = $result->fetch_assoc()) {
    $locations[] = $row['location'];
}

echo json_encode($locations);
?>