<?php
require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';

$errors = [];
$success = '';

// Suppression d'une promotion
if (isset($_POST['delete_promotion'])) {
    $promotion_id = $_POST['promotion_id'];
    $stmt = $conn->prepare("DELETE FROM promotions WHERE id = ?");
    $stmt->bind_param("i", $promotion_id);
    if ($stmt->execute()) {
        $success = __("Promotion deleted successfully!");
    } else {
        $errors[] = __("Failed to delete promotion.");
    }
    $stmt->close();
}

// Requête SQL pour récupérer les promotions
$query = "SELECT promotions.*, flights.departure_airport, flights.destination_airport FROM promotions JOIN flights ON promotions.flight_id = flights.id";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $errors[] = __("Failed to prepare SQL statement.");
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Manage Promotions"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Manage Promotions"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }

    if (!empty($success)) {
        echo '<div class="alert alert-success">';
        echo "<p>$success</p>";
        echo '</div>';
    }
    ?>
    <a href="add_promotion.php" class="btn btn-primary mb-3"><?php echo __("Add Promotion"); ?></a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo __("ID"); ?></th>
                <th><?php echo __("Flight"); ?></th>
                <th><?php echo __("Discount (%)"); ?></th>
                <th><?php echo __("Start Date"); ?></th>
                <th><?php echo __("End Date"); ?></th>
                <th><?php echo __("Actions"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $promotion): ?>
                <tr>
                    <td><?php echo $promotion['id']; ?></td>
                    <td><?php echo $promotion['departure_airport'] . " " . __("to") . " " . $promotion['destination_airport']; ?></td>
                    <td><?php echo $promotion['discount_percentage']; ?></td>
                    <td><?php echo $promotion['start_date']; ?></td>
                    <td><?php echo $promotion['end_date']; ?></td>
                    <td>
                        <a href="edit_promotion.php?id=<?php echo $promotion['id']; ?>" class="btn btn-primary btn-sm"><?php echo __("Edit"); ?></a>
                        <form action="promotions.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="promotion_id" value="<?php echo $promotion['id']; ?>">
                            <button type="submit" name="delete_promotion" class="btn btn-danger btn-sm"><?php echo __("Delete"); ?></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>