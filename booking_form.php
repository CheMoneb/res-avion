<?php
require 'db.php';
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$success_message = "";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connection_compte.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_id = $_POST['flight_id'];
    $user_id = $_SESSION['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $infants = $_POST['infants'];
    $pets = $_POST['pets'];
    
    // Générer une référence de réservation unique
    $reservation_reference = bin2hex(random_bytes(8));

    // Validation des champs
    if (empty($flight_id)) {
        $errors[] = __("Flight ID is required.");
    }
    if (empty($firstname)) {
        $errors[] = __("First name is required.");
    }
    if (empty($lastname)) {
        $errors[] = __("Last name is required.");
    }
    if (empty($email)) {
        $errors[] = __("Email is required.");
    }
    if (empty($phone)) {
        $errors[] = __("Phone number is required.");
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO reservations (flight_id, user_id, firstname, lastname, email, phone, reservation_reference, adults, children, infants, pets) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iisssssiiii', $flight_id, $user_id, $firstname, $lastname, $email, $phone, $reservation_reference, $adults, $children, $infants, $pets);
        if ($stmt->execute()) {
            $success_message = __("Booking successful!");
        } else {
            $errors[] = __("Failed to book the flight.");
        }
        $stmt->close();
    }
}

// Récupérer les informations de l'utilisateur
$user = [];
$stmt = $conn->prepare("SELECT firstname, lastname, email, phone FROM users WHERE id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Book a Flight"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center"><?php echo __("Book a Flight"); ?></h1>
    
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
    
    <form action="booking_form.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="flight_id"><?php echo __("Flight ID"); ?>:</label>
            <input type="text" name="flight_id" class="form-control" id="flight_id" required>
        </div>
        <div class="form-group">
            <label for="firstname"><?php echo __("First name"); ?>:</label>
            <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname"><?php echo __("Last name"); ?>:</label>
            <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email"><?php echo __("Email"); ?>:</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone"><?php echo __("Phone number"); ?>:</label>
            <input type="text" name="phone" class="form-control" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="adults"><?php echo __("Number of Adults"); ?>:</label>
            <input type="number" name="adults" class="form-control" id="adults" required>
        </div>
        <div class="form-group">
            <label for="children"><?php echo __("Number of Children"); ?>:</label>
            <input type="number" name="children" class="form-control" id="children" required>
        </div>
        <div class="form-group">
            <label for="infants"><?php echo __("Number of Infants"); ?>:</label>
            <input type="number" name="infants" class="form-control" id="infants" required>
        </div>
        <div class="form-group">
            <label for="pets"><?php echo __("Number of Pets"); ?>:</label>
            <input type="number" name="pets" class="form-control" id="pets" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Book Now"); ?></button>
    </form>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
