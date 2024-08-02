<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once 'translate.php';
$errors = [];
$results = [];
$searchPerformed = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['depart'], $_GET['destination'], $_GET['date_depart_start'], $_GET['trip_type'])) {
    $depart = trim($_GET['depart']);
    $destination = trim($_GET['destination']);
    $date_depart_start = trim($_GET['date_depart_start']);
    $trip_type = trim($_GET['trip_type']);
    $date_return = isset($_GET['date_return']) ? trim($_GET['date_return']) : null;
    $direct_only = isset($_GET['direct_only']) ? true : false;
    $adults = isset($_GET['adults']) ? intval($_GET['adults']) : 1;
    $children = isset($_GET['children']) ? intval($_GET['children']) : 0;
    $infants = isset($_GET['infants']) ? intval($_GET['infants']) : 0;
    $pet = isset($_GET['pet']) ? $_GET['pet'] : 'no';

    // Validation des données du formulaire
    if (empty($depart)) {
        $errors[] = __("Departure City is required.");
    }
    if (empty($destination)) {
        $errors[] = __("Destination City is required.");
    }
    if (empty($date_depart_start)) {
        $errors[] = __("Departure Date is required.");
    }
    if ($trip_type == 'round-trip' && empty($date_return)) {
        $errors[] = __("Return Date is required for round-trip.");
    }
    if ($adults <= 0) {
        $errors[] = __("Number of adults must be at least 1.");
    }
    if ($children < 0) {
        $errors[] = __("Number of children cannot be negative.");
    }
    if ($infants < 0) {
        $errors[] = __("Number of infants cannot be negative.");
    }

    if (empty($errors)) {
        $searchPerformed = true;
        $query = "SELECT * FROM flights WHERE departure_airport = ? AND destination_airport = ? AND departure_date = ?";
        if ($direct_only) {
            $query .= " AND direct_flight = 1";
        }
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sss", $depart, $destination, $date_depart_start);
            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $errors[] = __("Failed to prepare SQL statement.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("search_flights"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
    </style>
    <script>
        function swapLocations() {
            const departInput = document.getElementById('depart');
            const destinationInput = document.getElementById('destination');
            const temp = departInput.value;
            departInput.value = destinationInput.value;
            destinationInput.value = temp;
        }

        function toggleReturnDate() {
            const returnDateGroup = document.getElementById('return-date-group');
            const tripType = document.querySelector('input[name="trip_type"]:checked').value;
            returnDateGroup.style.display = tripType === 'round-trip' ? 'block' : 'none';
        }
    </script>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("Flights"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    
    <form action="recherche_vols.php" method="GET" class="form-container mx-auto" style="max-width: 800px;">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="depart"><?php echo __("Departure City"); ?>:</label>
                <input type="text" class="form-control" id="depart" name="depart" placeholder="e.g., New York" required>
            </div>
            <div class="form-group col-md-2 text-center d-flex align-items-end justify-content-center">
                <button type="button" class="btn btn-secondary rounded-circle" onclick="swapLocations()">
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </div>
            <div class="form-group col-md-5">
                <label for="destination"><?php echo __("Destination City"); ?>:</label>
                <input type="text" class="form-control" id="destination" name="destination" placeholder="e.g., London" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label><?php echo __("Trip Type"); ?>:</label><br>
                <input type="radio" name="trip_type" value="one-way" checked onclick="toggleReturnDate()"> <?php echo __("One-way"); ?>
                <input type="radio" name="trip_type" value="round-trip" onclick="toggleReturnDate()"> <?php echo __("Round-trip"); ?>
            </div>
            <div class="form-group col-md-4">
                <label for="date_depart_start"><?php echo __("Departure Date"); ?>:</label>
                <input type="date" class="form-control" id="date_depart_start" name="date_depart_start" required>
            </div>
            <div class="form-group col-md-4" id="return-date-group" style="display:none;">
                <label for="date_return"><?php echo __("Return Date"); ?>:</label>
                <input type="date" class="form-control" id="date_return" name="date_return">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="adults"><?php echo __("Adults (12+)"); ?>:</label>
                <select class="form-control" id="adults" name="adults" required>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="children"><?php echo __("Children (2-11)"); ?>:</label>
                <select class="form-control" id="children" name="children" required>
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="infants"><?php echo __("Infants (under 2)"); ?>:</label>
                <select class="form-control" id="infants" name="infants" required>
                    <?php for ($i = 0; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="pet"><?php echo __("Traveling with Pet"); ?>:</label>
                <select class="form-control" id="pet" name="pet" required>
                    <option value="no"><?php echo __("No"); ?></option>
                    <option value="yes"><?php echo __("Yes"); ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" id="direct_only" name="direct_only">
            <label for="direct_only"><?php echo __("Direct Flights Only"); ?></label>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("Search"); ?></button>
    </form>
    
    <?php if ($searchPerformed && empty($results)): ?>
        <p class="text-center"><?php echo __("No flights found."); ?></p>
        <?php elseif (!empty($results)): ?>
        <h2 class="text-center my-4"><?php echo __("Available Flights"); ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("Flight ID"); ?></th>
                    <th><?php echo __("Departure"); ?></th>
                    <th><?php echo __("Destination"); ?></th>
                    <th><?php echo __("Departure Date"); ?></th>
                    <th><?php echo __("Arrival Date"); ?></th>
                    <th><?php echo __("Status"); ?></th>
                    <th><?php echo __("Action"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $flight): ?>
                    <tr>
                        <td><?php echo $flight['id']; ?></td>
                        <td><?php echo $flight['departure_airport']; ?></td>
                        <td><?php echo $flight['destination_airport']; ?></td>
                        <td><?php echo $flight['departure_date']; ?></td>
                        <td><?php echo $flight['arrival_date']; ?></td>
                        <td><?php echo $flight['status']; ?></td>
                        <td>
                            <a href="booking_form.php?flight_id=<?php echo $flight['id']; ?>&adults=<?php echo $adults; ?>&children=<?php echo $children; ?>&infants=<?php echo $infants; ?>" class="btn btn-primary">
                                <?php echo __("Book"); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
```​⬤
   