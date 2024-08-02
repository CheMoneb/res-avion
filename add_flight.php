<?php
require 'db.php';
require_once 'translate.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_number = $_POST['flight_number'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $price = $_POST['price']; // Nouveau champ pour le prix

    // Validation des champs
    $errors = [];
    if (empty($flight_number)) {
        $errors[] = __("Flight number is required.");
    }
    if (empty($departure_airport)) {
        $errors[] = __("Departure airport is required.");
    }
    if (empty($arrival_airport)) {
        $errors[] = __("Arrival airport is required.");
    }
    if (empty($departure_time)) {
        $errors[] = __("Departure time is required.");
    }
    if (empty($arrival_time)) {
        $errors[] = __("Arrival time is required.");
    }
    if (empty($price) || !is_numeric($price)) {
        $errors[] = __("Price is required and must be a number.");
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO flights (flight_number, departure_airport, arrival_airport, departure_time, arrival_time, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssd', $flight_number, $departure_airport, $arrival_airport, $departure_time, $arrival_time, $price);

        if ($stmt->execute()) {
            $success_message = __("Flight added successfully.");
        } else {
            $errors[] = __("Failed to add flight.");
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Add Flight"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1 class="text-center"><?php echo __("Add Flight"); ?></h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success">
            <p><?php echo $success_message; ?></p>
        </div>
    <?php endif; ?>

    <form action="add_flight.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="flight_number"><?php echo __("Flight Number"); ?>:</label>
            <input type="text" name="flight_number" class="form-control" id="flight_number" required>
        </div>
        <div class="form-group">
            <label for="departure_airport"><?php echo __("Departure Airport"); ?>:</label>
            <input type="text" name="departure_airport" class="form-control" id="departure_airport" required>
        </div>
        <div class="form-group">
            <label for="arrival_airport"><?php echo __("Arrival Airport"); ?>:</label>
            <input type="text" name="arrival_airport" class="form-control" id="arrival_airport" required>
        </div>
        <div class="form-group">
            <label for="departure_time"><?php echo __("Departure Time"); ?>:</label>
            <input type="datetime-local" name="departure_time" class="form-control" id="departure_time" required>
        </div>
        <div class="form-group">
            <label for="arrival_time"><?php echo __("Arrival Time"); ?>:</label>
            <input type="datetime-local" name="arrival_time" class="form-control" id="arrival_time" required>
        </div>
        <div class="form-group">
            <label for="price"><?php echo __("Price"); ?>:</label>
            <input type="text" name="price" class="form-control" id="price" required>
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