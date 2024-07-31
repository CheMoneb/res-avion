<?php
require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_id = intval($_POST['flight_id']);
    $discount_percentage = floatval($_POST['discount_percentage']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);

    // Validation des données du formulaire
    if (empty($flight_id) || empty($discount_percentage) || empty($start_date) || empty($end_date)) {
        $errors[] = __("All fields are required.");
    } else {
        $stmt = $conn->prepare("INSERT INTO promotions (flight_id, discount_percentage, start_date, end_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idss", $flight_id, $discount_percentage, $start_date, $end_date);
        if ($stmt->execute()) {
            $success = __("Promotion added successfully!");
        } else {
            $errors[] = __("Failed to add promotion.");
        }
        $stmt->close();
    }
}

// Requête SQL pour récupérer les vols
$query = "SELECT * FROM flights";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->execute();
    $flights = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $errors[] = __("Failed to prepare SQL statement.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Add Promotion"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Add Promotion"); ?></h1>
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
    <form action="add_promotion.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="flight_id"><?php echo __("Flight"); ?>:</label>
            <select class="form-control" id="flight_id" name="flight_id" required>
                <?php foreach ($flights as $flight): ?>
                    <option value="<?php echo $flight['id']; ?>"><?php echo $flight['departure_airport'] . " to " . $flight['destination_airport']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="discount_percentage"><?php echo __("Discount Percentage"); ?>:</label>
            <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="start_date"><?php echo __("Start Date"); ?>:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date"><?php echo __("End Date"); ?>:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Add Promotion"); ?></button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>