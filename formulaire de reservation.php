<?php
require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';

function generateReservationReference() {
    return strtoupper(bin2hex(random_bytes(4)) . '-' . time());
}

$errors = [];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $flight_id = intval($_POST['flight_id']);
    $departure_airport = trim($_POST['departure_airport']);
    $destination_airport = trim($_POST['destination_airport']);
    $departure_date = trim($_POST['departure_date']);
    $status = "Booked"; // Par défaut, le statut est "Booked"
    $reservation_reference = generateReservationReference(); // Générer la référence de réservation

    if (empty($name)) {
        $errors[] = __("name_is_required");
    }
    if (empty($last_name)) {
        $errors[] = __("last_name_is_required");
    }
    if (empty($email)) {
        $errors[] = __("email_is_required");
    }
    if (empty($phone_number)) {
        $errors[] = __("phone_number_is_required");
    }
    if (empty($departure_airport)) {
        $errors[] = __("departure_airport_is_required");
    }
    if (empty($destination_airport)) {
        $errors[] = __("destination_airport_is_required");
    }
    if (empty($departure_date)) {
        $errors[] = __("departure_date_is_required");
    }

    if (empty($errors)) {
        // Insérer la réservation dans la base de données
        $stmt = $conn->prepare("INSERT INTO ma_reservation (name, last_name, reservation_reference, email, phone_number, flight_id, departure_airport, destination_airport, departure_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $name, $last_name, $reservation_reference, $email, $phone_number, $flight_id, $departure_airport, $destination_airport, $departure_date, $status);

        if ($stmt->execute()) {
            $success_message = __("booking_successful") . ' ' . $reservation_reference;
        } else {
            $errors[] = __("error_booking_flight") . ' ' . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Booking"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'inclure votre fichier CSS global -->
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container-flex">
        <div class="container">
            <h1 class="text-center my-4"><?php echo __("Booking"); ?></h1>
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
                <div class="form-group">
                    <label for="name"><?php echo __("name"); ?></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="last_name"><?php echo __("last_name"); ?></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email"><?php echo __("email"); ?></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number"><?php echo __("phone_number"); ?></label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="form-group">
                    <label for="flight_id"><?php echo __("flight_id"); ?></label>
                    <input type="text" class="form-control" id="flight_id" name="flight_id" required>
                </div>
                <div class="form-group">
                    <label for="departure_airport"><?php echo __("departure_airport"); ?></label>
                    <input type="text" class="form-control" id="departure_airport" name="departure_airport" required>
                </div>
                <div class="form-group">
                    <label for="destination_airport"><?php echo __("destination_airport"); ?></label>
                    <input type="text" class="form-control" id="destination_airport" name="destination_airport" required>
                </div>
                <div class="form-group">
                    <label for="departure_date"><?php echo __("departure_date"); ?></label>
                    <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><?php echo __("Book"); ?></button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>