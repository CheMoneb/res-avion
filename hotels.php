<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données

$errors = [];
$results = [];
$searchPerformed = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['city'], $_GET['checkin_date'], $_GET['checkout_date'])) {
    $city = trim($_GET['city']);
    $checkin_date = trim($_GET['checkin_date']);
    $checkout_date = trim($_GET['checkout_date']);
    $guests = isset($_GET['guests']) ? intval($_GET['guests']) : 1;

    // Validation des données du formulaire
    if (empty($city)) {
        $errors[] = "City is required.";
    }
    if (empty($checkin_date)) {
        $errors[] = "Check-in Date is required.";
    }
    if (empty($checkout_date)) {
        $errors[] = "Check-out Date is required.";
    }
    if ($guests <= 0) {
        $errors[] = "Number of guests must be at least 1.";
    }

    if (empty($errors)) {
        $searchPerformed = true;

        // Requête SQL pour rechercher les hôtels
        $stmt = $conn->prepare("SELECT * FROM hotels WHERE city = ? AND available_from <= ? AND available_to >= ?");
        $stmt->bind_param("sss", $city, $checkin_date, $checkout_date);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search for Hotels</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4">Search for Hotels</h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    <form action="hotels.php" method="GET" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="e.g., Paris" required>
        </div>
        <div class="form-group">
            <label for="checkin_date">Check-in Date:</label>
            <input type="date" class="form-control" id="checkin_date" name="checkin_date" required>
        </div>
        <div class="form-group">
            <label for="checkout_date">Check-out Date:</label>
            <input type="date" class="form-control" id="checkout_date" name="checkout_date" required>
        </div>
        <div class="form-group">
            <label for="guests">Number of Guests:</label>
            <select class="form-control" id="guests" name="guests" required>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Search</button>
    </form>
    
    <?php if ($searchPerformed && empty($results)): ?>
        <p class="text-center">No hotels found.</p>
    <?php elseif (!empty($results)): ?>
        <h2 class="text-center my-4">Available Hotels</h2>
        <table class="table table-striped"> </table>
        <thead>
            <tr>
                <th>Hotel ID</th>
                <th>Name</th>
                <th>City</th>
                <th>Available From</th>
                <th>Available To</th>
                <th>Price per Night</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $hotel): ?>
                <tr>
                    <td><?php echo $hotel['id']; ?></td>
                    <td><?php echo $hotel['name']; ?></td>
                    <td><?php echo $hotel['city']; ?></td>
                    <td><?php echo $hotel['available_from']; ?></td>
                    <td><?php echo $hotel['available_to']; ?></td>
                    <td><?php echo $hotel['price_per_night']; ?></td>
                    <td><a href="book_hotel.php?hotel_id=<?php echo $hotel['id']; ?>&checkin_date=<?php echo $checkin_date; ?>&checkout_date=<?php echo $checkout_date; ?>&guests=<?php echo $guests; ?>" class="btn btn-primary">Book</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


