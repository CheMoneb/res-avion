<?php
require_once 'db.php';
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

if (isset($_GET['id'])) {
    $flight_id = intval($_GET['id']);
    // Récupérer les informations du vol
    $stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");
    $stmt->bind_param('i', $flight_id);
    $stmt->execute();
    $flight = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$flight) {
        $errors[] = __("Flight not found.");
    }
} else {
    $errors[] = __("Flight ID is required.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['flight_id'])) {
    $flight_id = intval($_POST['flight_id']);
    $flight_number = $_POST['flight_number'];
    $departure_airport = $_POST['departure_airport'];
    $destination_airport = $_POST['destination_airport'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $status = $_POST['status'];
    $price = $_POST['price'];

    // Validation des champs
    if (empty($flight_number)) {
        $errors[] = __("Flight number is required.");
    }
    if (empty($departure_airport)) {
        $errors[] = __("Departure airport is required.");
    }
    if (empty($destination_airport)) {
        $errors[] = __("Destination airport is required.");
    }
    if (empty($departure_date)) {
        $errors[] = __("Departure date is required.");
    }
    if (empty($arrival_date)) {
        $errors[] = __("Arrival date is required.");
    }
    if (empty($status)) {
        $errors[] = __("Status is required.");
    }
    if (empty($price) || !is_numeric($price)) {
        $errors[] = __("Valid price is required.");
    }

    if (empty($errors)) {
        // Mettre à jour les informations du vol
        $stmt = $conn->prepare("UPDATE flights SET flight_number = ?, departure_airport = ?, destination_airport = ?, departure_date = ?, arrival_date = ?, status = ?, price = ? WHERE id = ?");
        $stmt->bind_param('ssssssdi', $flight_number, $departure_airport, $destination_airport, $departure_date, $arrival_date, $status, $price, $flight_id);

        if ($stmt->execute()) {
            $success_message = __("Flight updated successfully.");
            // Récupérer les informations mises à jour du vol
            $stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");
            $stmt->bind_param('i', $flight_id);
            $stmt->execute();
            $flight = $stmt->get_result()->fetch_assoc();
            $stmt->close();
        } else {
            $errors[] = __("Failed to update flight.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Edit Flight"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Edit Flight"); ?></h1>
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

    <?php if ($flight): ?>
        <form action="edit_flight.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
            <input type="hidden" name="flight_id" value="<?php echo htmlspecialchars($flight['id']); ?>">
            <div class="form-group">
                <label for="flight_number"><?php echo __("Flight Number"); ?>:</label>
                <input type="text" name="flight_number" class="form-control" id="flight_number" value="<?php echo htmlspecialchars($flight['flight_number']); ?>" required>
            </div>
            <div class="form-group">
                <label for="departure_airport"><?php echo __("Departure Airport"); ?>:</label>
                <input type="text" name="departure_airport" class="form-control" id="departure_airport" value="<?php echo htmlspecialchars($flight['departure_airport']); ?>" required>
            </div>
            <div class="form-group">
                <label for="destination_airport"><?php echo __("Destination Airport"); ?>:</label>
                <input type="text" name="destination_airport" class="form-control" id="destination_airport" value="<?php echo htmlspecialchars($flight['destination_airport']); ?>" required>
            </div>
            <div class="form-group">
                <label for="departure_date"><?php echo __("Departure Date"); ?>:</label>
                <input type="datetime-local" name="departure_date" class="form-control" id="departure_date" value="<?php echo htmlspecialchars($flight['departure_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="arrival_date"><?php echo __("Arrival Date"); ?>:</label>
                <input type="datetime-local" name="arrival_date" class="form-control" id="arrival_date" value="<?php echo htmlspecialchars($flight['arrival_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="status"><?php echo __("Status"); ?>:</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="Scheduled" <?php echo ($flight['status'] == 'Scheduled') ? 'selected' : ''; ?>><?php echo __("Scheduled"); ?></option>
                    <option value="Delayed" <?php echo ($flight['status'] == 'Delayed') ? 'selected' : ''; ?>><?php echo __("Delayed"); ?></option>
                    <option value="Cancelled" <?php echo ($flight['status'] == 'Cancelled') ? 'selected' : ''; ?>><?php echo __("Cancelled"); ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="price"><?php echo __("Price"); ?>:</label>
                <input type="number" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($flight['price']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?php echo __("Update Flight"); ?></button>
        </form>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>