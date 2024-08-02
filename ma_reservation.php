<?php
require 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connection_compte.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$errors = [];
$hotel_reservations = [];
$flight_reservations = [];

// Récupérer les réservations d'hôtel
$stmt = $conn->prepare("SELECT * FROM hotel_reservations WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$hotel_reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Récupérer les réservations de vol
$stmt = $conn->prepare("SELECT * FROM flight_reservations WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$flight_reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("My Reservations"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'inclure votre fichier CSS global -->
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("My Reservations"); ?></h1>
    
    <!-- Réservations d'hôtel -->
    <h2 class="text-center my-4"><?php echo __("Hotel Reservations"); ?></h2>
    <?php if (!empty($hotel_reservations)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("Hotel Name"); ?></th>
                    <th><?php echo __("Check-in Date"); ?></th>
                    <th><?php echo __("Check-out Date"); ?></th>
                    <th><?php echo __("Guests"); ?></th>
                    <th><?php echo __("Price"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotel_reservations as $reservation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reservation['hotel_name']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['checkin_date']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['checkout_date']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['guests']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center"><?php echo __("No hotel reservations found."); ?></p>
    <?php endif; ?>

    <!-- Réservations de vol -->
    <h2 class="text-center my-4"><?php echo __("Flight Reservations"); ?></h2>
    <?php if (!empty($flight_reservations)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("Flight Number"); ?></th>
                    <th><?php echo __("Departure Date"); ?></th>
                    <th><?php echo __("Arrival Date"); ?></th>
                    <th><?php echo __("Departure Airport"); ?></th>
                    <th><?php echo __("Arrival Airport"); ?></th>
                    <th><?php echo __("Price"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flight_reservations as $reservation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reservation['flight_number']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['departure_date']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['arrival_date']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['departure_airport']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['arrival_airport']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center"><?php echo __("No flight reservations found."); ?></p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>