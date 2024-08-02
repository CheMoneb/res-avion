<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once 'translate.php';
$errors = [];
$success_message = "";

// Pour supprimer un hôtel
if (isset($_GET['delete_hotel_id'])) {
    $delete_hotel_id = intval($_GET['delete_hotel_id']);
    $stmt = $conn->prepare("DELETE FROM hotels WHERE id = ?");
    $stmt->bind_param("i", $delete_hotel_id);
    if ($stmt->execute()) {
        $success_message = __("Hotel deleted successfully.");
    } else {
        $errors[] = __("Failed to delete hotel.");
    }
    $stmt->close();
}

// Pour afficher tous les hôtels
$stmt = $conn->prepare("SELECT * FROM hotels");
$stmt->execute();
$hotels = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Manage Hotels"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Manage Hotels"); ?></h1>
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo __("Hotel ID"); ?></th>
                <th><?php echo __("Name"); ?></th>
                <th><?php echo __("Location"); ?></th>
                <th><?php echo __("Available From"); ?></th>
                <th><?php echo __("Available To"); ?></th>
                <th><?php echo __("Arrival Time"); ?></th>
                <th><?php echo __("Price per Night"); ?></th>
                <th><?php echo __("Action"); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotels as $hotel): ?>
                <tr>
                    <td><?php echo $hotel['id']; ?></td>
                    <td><?php echo $hotel['name']; ?></td>
                    <td><?php echo $hotel['location']; ?></td>
                    <td><?php echo $hotel['available_from']; ?></td>
                    <td><?php echo $hotel['available_to']; ?></td>
                    <td><?php echo $hotel['arrival_time']; ?></td>
                    <td><?php echo $hotel['price_per_night']; ?></td>
                    <td>
                        <a href="edit_hotel.php?id=<?php echo $hotel['id']; ?>" class="btn btn-primary"><?php echo __("Edit"); ?></a>
                        <a href="manage_hotels.php?delete_hotel_id=<?php echo $hotel['id']; ?>" class="btn btn-danger" onclick="return confirm('<?php echo __("Are you sure you want to delete this hotel?"); ?>')"><?php echo __("Delete"); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>