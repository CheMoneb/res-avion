<?php
require 'db.php';
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: connection_compte.php');
    exit();
}

$errors = [];
$success_message = "";

// Pour annuler une réservation
if (isset($_GET['cancel_reservation_id'])) {
    $cancel_reservation_id = intval($_GET['cancel_reservation_id']);
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cancel_reservation_id, $_SESSION['user_id']);
    if ($stmt->execute()) {
        $success_message = __("Reservation cancelled successfully.");
    } else {
        $errors[] = __("Failed to cancel reservation.");
    }
    $stmt->close();
}

// Pour afficher les réservations de l'utilisateur
$stmt = $conn->prepare("SELECT reservations.*, flights.departure_airport, flights.destination_airport, flights.departure_date FROM reservations JOIN flights ON reservations.flight_id = flights.id WHERE reservations.user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("My Reservations"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("My Reservations"); ?></h1>
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
        echo '</div>';
    }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo __("Reservation ID"); ?></th>
                <th><?php echo __("Flight ID"); ?></th>
                <th><?php echo __("Departure Airport"); ?></th>
                <th><?php echo __("Destination Airport"); ?></th>
                <th><?php echo __("Departure Date"); ?></th>
                <th><?php echo __("Action"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['flight_id']; ?></td>
                    <td><?php echo $reservation['departure_airport']; ?></td>
                    <td><?php echo $reservation['destination_airport']; ?></td>
                    <td><?php echo $reservation['departure_date']; ?></td>
                    <td>
                        <a href="view_reservation.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary"><?php echo __("View"); ?></a>
                        <a href="my_reservations.php?cancel_reservation_id=<?php echo $reservation['id']; ?>" class="btn btn-danger" onclick="return confirm('<?php echo __("Are you sure you want to cancel this reservation?"); ?>')"><?php echo __("Cancel"); ?></a>
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