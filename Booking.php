<?php
require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données

$errors = [];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['flight_id'])) {
        $flight_id = intval($_POST['flight_id']);
        // Utilisation d'un ID utilisateur statique pour le test
        $user_id = 1; // Remplacez ceci par un ID utilisateur valide

        if (empty($flight_id)) {
            $errors[] = "Flight ID is required.";
        }

        if (empty($user_id)) {
            $errors[] = "User ID is required.";
        }

        if (empty($errors)) {
            // Insérer la réservation dans la base de données
            $stmt = $conn->prepare("INSERT INTO reservations (flight_id, user_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $flight_id, $user_id);

            if ($stmt->execute()) {
                $success_message = "Booking successful!";
            } else {
                $errors[] = "Error booking the flight: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $errors[] = "No flight selected for booking.";
    }
} else {
    if (isset($_GET['flight_id'])) {
        $flight_id = intval($_GET['flight_id']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Assurez-vous d'inclure votre fichier CSS global -->
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="text-center my-4">Booking</h1>
        <?php
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo '</div>';
        }

        if (!empty($success_message)) {
            echo '<div class="alert alert-success">';
            echo "<p>$success_message</p>";
            echo '</div>';
        }
        ?>
        <form action="booking.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
            <input type="hidden" name="flight_id" value="<?php echo isset($flight_id) ? $flight_id : ''; ?>">
            <div class="form-group">
                <label for="flight_id_display">Flight ID</label>
                <input type="text" class="form-control" id="flight_id_display" value="<?php echo isset($flight_id) ? $flight_id : ''; ?>" disabled>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Book</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>