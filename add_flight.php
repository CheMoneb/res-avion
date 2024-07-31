<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departure_airport = trim($_POST['departure_airport']);
    $destination_airport = trim($_POST['destination_airport']);
    $departure_date = trim($_POST['departure_date']);
    $arrival_date = trim($_POST['arrival_date']);
    $direct_flight = isset($_POST['direct_flight']) ? 1 : 0;
    $status = trim($_POST['status']);

    // Validation des données du formulaire
    if (empty($departure_airport)) {
        $errors[] = __("Departure Airport is required.");
    }
    if (empty($destination_airport)) {
        $errors[] = __("Destination Airport is required.");
    }
    if (empty($departure_date)) {
        $errors[] = __("Departure Date is required.");
    }
    if (empty($arrival_date)) {
        $errors[] = __("Arrival Date is required.");
    }
    if (empty($status)) {
        $errors[] = __("Status is required.");
    }

    if (empty($errors)) {
        // Requête SQL pour ajouter le vol
        $stmt = $conn->prepare("INSERT INTO flights (departure_airport, destination_airport, departure_date, arrival_date, direct_flight, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $departure_airport, $destination_airport, $departure_date, $arrival_date, $direct_flight, $status);
        if ($stmt->execute()) {
            $success = __("Flight added successfully!");
        } else {
            $errors[] = __("Failed to add flight.");
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Add Flight"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Add Flight"); ?></h1>
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
    <form action="add_flight.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="departure_airport"><?php echo __("Departure Airport"); ?>:</label>
            <input type="text" class="form-control" id="departure_airport" name="departure_airport" required>
        </div>
        <div class="form-group">
            <label for="destination_airport"><?php echo __("Destination Airport"); ?>:</label>
            <input type="text" class="form-control" id="destination_airport" name="destination_airport" required>
        </div>
        <div class="form-group">
            <label for="departure_date"><?php echo __("Departure Date"); ?>:</label>
            <input type="date" class="form-control" id="departure_date" name="departure_date" required>
        </div>
        <div class="form-group">
            <label for="arrival_date"><?php echo __("Arrival Date"); ?>:</label>
            <input type="date" class="form-control" id="arrival_date" name="arrival_date" required>
        </div>
        <div class="form-group">
            <label for="status"><?php echo __("Status"); ?>:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Scheduled"><?php echo __("Scheduled"); ?></option>
                <option value="Delayed"><?php echo __("Delayed"); ?></option>
                <option value="Cancelled"><?php echo __("Cancelled"); ?></option>
            </select>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="direct_flight" name="direct_flight">
            <label class="form-check-label" for="direct_flight"><?php echo __("Direct Flight"); ?></label>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Add Flight"); ?></button>
    </form>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>