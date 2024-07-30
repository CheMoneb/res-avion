<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';
require 'get_airports.php'; // Assuming this file fetches the list of airports

$errors = [];
$searchPerformed = false;
$results = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['depart'], $_GET['destination'], $_GET['date_depart_start'], $_GET['trip_type'])) {
    $depart = trim($_GET['depart']);
    $destination = trim($_GET['destination']);
    $date_depart_start = trim($_GET['date_depart_start']);
    $trip_type = trim($_GET['trip_type']);
    $date_return = isset($_GET['date_return']) ? trim($_GET['date_return']) : null;
    $direct_only = isset($_GET['direct_only']) ? true : false;
    $travelers = isset($_GET['travelers']) ? intval($_GET['travelers']) : 1;

    // Validation des données du formulaire
    if (empty($depart)) {
        $errors[] = __("departure_city_required");
    }
    if (empty($destination)) {
        $errors[] = __("destination_city_required");
    }
    if (empty($date_depart_start)) {
        $errors[] = __("departure_date_required");
    }
    if ($trip_type == 'round-trip' && empty($date_return)) {
        $errors[] = __("return_date_required");
    }
    if ($travelers <= 0) {
        $errors[] = __("number_of_travelers_required");
    }

    if (empty($errors)) {
        $searchPerformed = true;

        // Requête SQL pour rechercher les vols
        $query = "SELECT * FROM vols WHERE departure_airport = ? AND destination_airport = ? AND departure_date = ?";
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
            $errors[] = __("failed_to_prepare_sql");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("search_flights"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("search_flights"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    
    <form action="recherche_vols.php" method="GET" class="form-container mx-auto" style="max-width: 600px;">
        <div class="form-group">
            <label for="depart"><?php echo __("departure_city"); ?>:</label>
            <input type="text" class="form-control" id="depart" name="depart" placeholder="<?php echo __("e.g., New York"); ?>" required>
        </div>
        <div class="form-group">
            <label for="destination"><?php echo __("destination_city"); ?>:</label>
            <input type="text" class="form-control" id="destination" name="destination" placeholder="<?php echo __("e.g., London"); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo __("trip_type"); ?>:</label><br>
            <input type="radio" name="trip_type" value="one-way" checked onclick="toggleReturnDate()"> <?php echo __("one_way"); ?>
            <input type="radio" name="trip_type" value="round-trip" onclick="toggleReturnDate()"> <?php echo __("round_trip"); ?>
        </div>
        <div class="form-group">
            <label for="date_depart_start"><?php echo __("departure_date"); ?>:</label>
            <input type="date" class="form-control" id="date_depart_start" name="date_depart_start" required>
        </div>
        <div class="form-group" id="return-date-group" style="display:none;">
            <label for="date_return"><?php echo __("return_date"); ?>:</label>
            <input type="date" class="form-control" id="date_return" name="date_return">
        </div>
        <div class="form-group">
            <label for="travelers"><?php echo __("number_of_travelers"); ?>:</label>
            <select class="form-control" id="travelers" name="travelers" required>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="checkbox" id="direct_only" name="direct_only">
            <label for="direct_only"><?php echo __("direct_flights_only"); ?></label>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("search"); ?></button>
    </form>
    
    <?php if ($searchPerformed && empty($results)): ?>
        <p class="text-center"><?php echo __("no_flights_found"); ?></p>
    <?php elseif (!empty($results)): ?>
        <h2 class="text-center my-4"><?php echo __("available_flights"); ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("flight_id"); ?></th>
                    <th><?php echo __("departure"); ?></th>
                    <th><?php echo __("destination"); ?></th>
                    <th><?php echo __("departure_date"); ?></th>
                    <th><?php echo __("arrival_date"); ?></th>
                    <th><?php echo __("status"); ?></th>
                    <th><?php echo __("action"); ?></th>
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
                        <td><a href="booking.php?flight_id=<?php echo $flight['id']; ?>&travelers=<?php echo $travelers; ?>" class="btn btn-primary"><?php echo __("book"); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    function toggleReturnDate() {
        const returnDateGroup = document.getElementById('return-date-group');
        const tripType = document.querySelector('input[name="trip_type"]:checked').value;
        returnDateGroup.style.display = tripType === 'round-trip' ? 'block' : 'none';
    }
</script>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>