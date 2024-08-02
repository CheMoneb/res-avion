<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';
$errors = [];
$results = [];
$searchPerformed = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $city = isset($_GET['city']) ? trim($_GET['city']) : '';
    $checkin_date = isset($_GET['checkin_date']) ? trim($_GET['checkin_date']) : '';
    $checkout_date = isset($_GET['checkout_date']) ? trim($_GET['checkout_date']) : '';
    $guests = isset($_GET['guests']) ? intval($_GET['guests']) : 1;

    if (!empty($city) || !empty($checkin_date) || !empty($checkout_date)) {
        $searchPerformed = true;

        // Requête SQL pour rechercher les hôtels
        $query = "SELECT * FROM hotels WHERE 1=1";
        $params = [];
        $types = '';

        if (!empty($city)) {
            $query .= " AND location = ?";
            $params[] = $city;
            $types .= 's';
        }

        if (!empty($checkin_date)) {
            $query .= " AND available_from <= ?";
            $params[] = $checkin_date;
            $types .= 's';
        }

        if (!empty($checkout_date)) {
            $query .= " AND available_to >= ?";
            $params[] = $checkout_date;
            $types .= 's';
        }

        $stmt = $conn->prepare($query);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Search for Hotels"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Search for Hotels"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>" . __($error) . "</p>";
        }
        echo '</div>';
    }
    ?>
    <form action="hotels.php" method="GET" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="city"><?php echo __("City"); ?>:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="<?php echo __("e.g., Paris"); ?>">
        </div>
        <div class="form-group">
            <label for="checkin_date"><?php echo __("Check-in Date"); ?>:</label>
            <input type="date" class="form-control" id="checkin_date" name="checkin_date">
        </div>
        <div class="form-group">
            <label for="checkout_date"><?php echo __("Check-out Date"); ?>:</label>
            <input type="date" class="form-control" id="checkout_date" name="checkout_date">
        </div>
        <div class="form-group">
            <label for="guests"><?php echo __("Number of Guests"); ?>:</label>
            <select class="form-control" id="guests" name="guests" required>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Search"); ?></button>
    </form>
    
    <?php if ($searchPerformed && empty($results)): ?>
        <p class="text-center"><?php echo __("No hotels found."); ?></p>
    <?php elseif (!empty($results)): ?>
        <h2 class="text-center my-4"><?php echo __("Available Hotels"); ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("Hotel ID"); ?></th>
                    <th><?php echo __("Name"); ?></th>
                    <th><?php echo __("Location"); ?></th>
                    <th><?php echo __("Available From"); ?></th>
                    <th><?php echo __("Available To"); ?></th>
                    <th><?php echo __("Price per Night"); ?></th>
                    <th><?php echo __("Action"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $hotel): ?>
                    <tr>
                        <td><?php echo $hotel['id']; ?></td>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['location']; ?></td>
                        <td><?php echo $hotel['available_from']; ?></td>
                        <td><?php echo $hotel['available_to']; ?></td>
                        <td><?php echo $hotel['price_per_night']; ?></td>
                        <td>
                            <a href="book_hotel.php?hotel_id=<?php echo $hotel['id']; ?>&checkin_date=<?php echo $checkin_date; ?>&checkout_date=<?php echo $checkout_date; ?>&guests=<?php echo $guests; ?>" class="btn btn-primary"><?php echo __("Book"); ?></a>
                            <a href="edit_hotel.php?id=<?php echo $hotel['id']; ?>" class="btn btn-primary"><?php echo __("Edit"); ?></a>
                            <a href="manage_hotels.php?delete_hotel_id=<?php echo $hotel['id']; ?>" class="btn btn-danger" onclick="return confirm('<?php echo __("Are you sure you want to delete this hotel?"); ?>')"><?php echo __("Delete"); ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
