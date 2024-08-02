<?php
require 'db.php';
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$success_message = "";

if (!isset($_GET['id'])) {
    header('Location: manage_hotels.php');
    exit();
}

$hotel_id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $available_from = $_POST['available_from'];
    $available_to = $_POST['available_to'];
    $price_per_night = $_POST['price_per_night'];

    if (empty($name) || empty($location) || empty($available_from) || empty($available_to) || empty($price_per_night)) {
        $errors[] = __("All fields are required.");
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE hotels SET name = ?, location = ?, available_from = ?, available_to = ?, price_per_night = ? WHERE id = ?");
        $stmt->bind_param('ssssdi', $name, $location, $available_from, $available_to, $price_per_night, $hotel_id);

        if ($stmt->execute()) {
            $success_message = __("Hotel updated successfully.");
        } else {
            $errors[] = __("Failed to update hotel.");
        }
        $stmt->close();
    }
}

$stmt = $conn->prepare("SELECT * FROM hotels WHERE id = ?");
$stmt->bind_param('i', $hotel_id);
$stmt->execute();
$hotel = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$hotel) {
    header('Location: manage_hotels.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Edit Hotel"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Edit Hotel"); ?></h1>
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
    <form action="edit_hotel.php?id=<?php echo $hotel_id; ?>" method="POST" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="name"><?php echo __("Name"); ?>:</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($hotel['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="location"><?php echo __("Location"); ?>:</label>
            <input type="text" name="location" class="form-control" id="location" value="<?php echo htmlspecialchars($hotel['location']); ?>" required>
        </div>
        <div class="form-group">
            <label for="available_from"><?php echo __("Available From"); ?>:</label>
            <input type="date" name="available_from" class="form-control" id="available_from" value="<?php echo htmlspecialchars($hotel['available_from']); ?>" required>
        </div>
        <div class="form-group">
            <label for="available_to"><?php echo __("Available To"); ?>:</label>
            <input type="date" name="available_to" class="form-control" id="available_to" value="<?php echo htmlspecialchars($hotel['available_to']); ?>" required>
        </div>
        <div class="form-group">
            <label for="price_per_night"><?php echo __("Price per Night"); ?>:</label>
            <input type="number" step="0.01" name="price_per_night" class="form-control" id="price_per_night" value="<?php echo htmlspecialchars($hotel['price_per_night']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Update Hotel"); ?></button>
    </form>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>