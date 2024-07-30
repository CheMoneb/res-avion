<?php
require 'db.php';

$sql = "SELECT `name` FROM `airports`";
$results = mysqli_query($conn, $sql);
