<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];

    $sql = 'DELETE FROM aeroport WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    var_dump($stmt);
    echo 'aéroport supprimé';
}


$sql = "SELECT * FROM reservation_vols.airports";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
   }
} else {
  echo "0 results";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer</title>
</head>
<body>
    <h1>Supprimer</h1>

    <form method="POST" action="delete.php">
        <label for="id">aeroport supprimer:</label><br>
        <select id="id" name="id" required>
            <?php foreach ($aeroports as $aeroport): ?>
                <option value="<?php echo htmlspecialchars($aeroport['id']); ?>">
                    <?php echo htmlspecialchars($aeroport['titre']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="Supprimer">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p><?php echo htmlspecialchars('aeroport supprimé'); ?></p>
    <?php endif; ?>
</body>
</html>
