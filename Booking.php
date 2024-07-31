<?php
require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';
$errors = [];
$reservation = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_number = trim($_POST['reservation_number']);
    $email = trim($_POST['email']);
    $last_name = trim($_POST['last_name']);

    // Validation des données du formulaire
    if (empty($reservation_number)) {
        $errors[] = __("reservation_number_is_required");
    }
    if (empty($email)) {
        $errors[] = __("email_is_required");
    }
    if (empty($last_name)) {
        $errors[] = __("last_name_is_required");
    }

    if (empty($errors)) {
        // Requête SQL pour rechercher la réservation
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE reservation_number = ? AND email = ? AND last_name = ?");
        if ($stmt) {
            $stmt->bind_param("sss", $reservation_number, $email, $last_name);
            $stmt->execute();
            $result = $stmt->get_result();
            $reservation = $result->fetch_assoc();
            $stmt->close();

            if (!$reservation) {
                $errors[] = __("no_reservation_found");
            }
        } else {
            $errors[] = __("failed_to_prepare_sql_statement");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("find_my_reservation"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'inclure votre fichier CSS global -->
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("find_my_reservation"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>

    <form action="find_reservation.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="reservation_number"><?php echo __("reservation_number"); ?></label>
            <input type="text" class="form-control" id="reservation_number" name="reservation_number" placeholder="e.g., ABC123" required>
        </div>
        <div class="form-group">
            <label for="email"><?php echo __("email"); ?></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="e.g., user@example.com" required>
        </div>
        <div class="form-group">
            <label for="last_name"><?php echo __("last_name"); ?></label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="e.g., Smith" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("find_reservation"); ?></button>
    </form>

    <?php if ($reservation): ?>
        <h2 class="text-center my-4"><?php echo __("reservation_details"); ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("flight_id"); ?></th>
                    <th><?php echo __("departure"); ?></th>
                    <th><?php echo __("destination"); ?></th>
                    <th><?php echo __("departure_date"); ?></th>
                    <th><?php echo __("status"); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $reservation['flight_id']; ?></td>
                    <td><?php echo $reservation['departure_airport']; ?></td>
                    <td><?php echo $reservation['destination_airport']; ?></td>
                    <td><?php echo $reservation['departure_date']; ?></td>
                    <td><?php echo $reservation['status']; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <a href="manage_reservation.php?reservation_id=<?php echo $reservation['id']; ?>" class="btn btn-primary"><?php echo __("manage_reservation"); ?></a>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>