<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once 'translate.php';
$errors = [];
$success_message = "";

// Pour supprimer un vol
if (isset($_GET['delete_flight_id'])) {
    $delete_flight_id = intval($_GET['delete_flight_id']);
    $stmt = $conn->prepare("DELETE FROM flights WHERE id = ?");
    $stmt->bind_param("i", $delete_flight_id);
    if ($stmt->execute()) {
        $success_message = __("Flight deleted successfully.");
    } else {
        $errors[] = __("Failed to delete flight.");
    }
    $stmt->close();
}

// Pour afficher tous les vols
$stmt = $conn->prepare("SELECT * FROM flights");
$stmt->execute();
$flights = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Manage Flights"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Manage Flights"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>" . __($error) . "</p>";
        }
        echo '</div>';
    }
    if (!empty($success_message)) {
        echo '<div class="alert alert-success">';
        echo "<p>" . __($success_message) . "</p>";
    }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo __("Flight ID"); ?></th>
                <th><?php echo __("Departure Airport"); ?></th>
                <th><?php echo __("Destination Airport"); ?></th>
                <th><?php echo __("Departure Date"); ?></th>
                <th><?php echo __("Arrival Date"); ?></th>
                <th><?php echo __("Price"); ?></th>
                <th><?php echo __("Action"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flights as $flight): ?>
                <tr>
                    <td><?php echo $flight['id']; ?></td>
                    <td><?php echo $flight['departure_airport']; ?></td>
                    <td><?php echo $flight['destination_airport']; ?></td>
                    <td><?php echo $flight['departure_date']; ?></td>
                    <td><?php echo $flight['arrival_date']; ?></td>
                    <td><?php echo $flight['price']; ?></td>
                    <td>
                        <a href="edit_flight.php?id=<?php echo $flight['id']; ?>" class="btn btn-primary"><?php echo __("Edit"); ?></a>
                        <a href="manage_flights.php?delete_flight_id=<?php echo $flight['id']; ?>" class="btn btn-danger" onclick="return confirm('<?php echo __("Are you sure you want to delete this flight?"); ?>')"><?php echo __("Delete"); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>