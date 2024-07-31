<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once 'translate.php';

$errors = [];
$success = '';

$promotion_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion_id = intval($_POST['promotion_id']);
    $flight_id = intval($_POST['flight_id']);
    $discount_percentage = floatval($_POST['discount_percentage']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);

    // Validation des données du formulaire
    if (empty($flight_id) || empty($discount_percentage) || empty($start_date) || empty($end_date)) {
        $errors[] = __("All fields are required.");
    } else {
        $stmt = $conn->prepare("UPDATE promotions SET flight_id = ?, discount_percentage = ?, start_date = ?, end_date = ? WHERE id = ?");
        $stmt->bind_param("idssi", $flight_id, $discount_percentage, $start_date, $end_date, $promotion_id);
        if ($stmt->execute()) {
            $success = __("Promotion updated successfully!");
        } else {
            $errors[] = __("Failed to update promotion.");
        }
        $stmt->close();
    }
}

// Requête SQL pour récupérer la promotion actuelle
$promotionQuery = "SELECT * FROM promotions WHERE id = ?";
$stmt = $conn->prepare($promotionQuery);
if ($stmt) {
    $stmt->bind_param("i", $promotion_id);
    $stmt->execute();
    $promotion = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    $errors[] = __("Failed to prepare SQL statement.");
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
    <title><?php echo __("Edit Promotion"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Edit Promotion"); ?></h1>
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
    <form action="edit_promotion.php?id=<?php echo $promotion_id; ?>" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <input type="hidden" name="promotion_id" value="<?php echo $promotion_id; ?>">
        <div class="form-group">
            <label for="flight_id"><?php echo __("Flight"); ?>:</label>
            <select class="form-control" id="flight_id" name="flight_id" required>
                <?php foreach ($flights as $flight): ?>
                    <option value="<?php echo $flight['id']; ?>" <?php echo ($flight['id'] == $promotion['flight_id']) ? 'selected' : ''; ?>>
                        <?php echo $flight['departure_airport'] . " to " . $flight['destination_airport']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="discount_percentage"><?php echo __("Discount Percentage"); ?>:</label>
            <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" step="0.01" value="<?php echo $promotion['discount_percentage']; ?>" required>
        </div>
        <div class="form-group">
            <label for="start_date"><?php echo __("Start Date"); ?>:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $promotion['start_date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="end_date"><?php echo __("End Date"); ?>:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $promotion['end_date']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Update Promotion"); ?></button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>