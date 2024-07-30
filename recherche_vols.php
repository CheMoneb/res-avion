<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once 'translate.php';
require 'get_airports.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['depart'], $_GET['destination'], $_GET['date_depart_start'], $_GET['trip_type'])) {
    $depart = trim($_GET['depart']);
    $destination = trim($_GET['destination']);
    $date_depart_start = trim($_GET['date_depart_start']);
    $trip_type = trim($_GET['trip_type']);
    $date_return = isset($_GET['date_return']) ? trim($_GET['date_return']) : null;

    // Validation des données du formulaire
    if (empty($depart)) {
        $errors[] = __("departure_city") . " " . __("is_required");
    }
    if (empty($destination)) {
        $errors[] = __("destination_city") . " " . __("is_required");
    }
    if (empty($date_depart_start)) {
        $errors[] = __("departure_date") . " " . __("is_required");
    }
    if ($trip_type == 'round-trip' && empty($date_return)) {
        $errors[] = __("return_date") . " " . __("is_required_for_round_trip");
    }

    if (empty($errors)) {
        // Requête SQL pour rechercher les vols
        $stmt = $conn->prepare("SELECT * FROM flights WHERE departure_airport = ? AND destination_airport = ? AND departure_date = ?");
        if ($stmt) {
            $stmt->bind_param("sss", $depart, $destination, $date_depart_start);
            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $errors[] = __("failed_to_search_flights");
            error_log("Failed to prepare SQL statement: " . $conn->error);
        }
    }
}

include 'header.php';
?>

<div class="container">
    <h1 class="text-center my-4 text-white"><?php echo __("search_flights"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    <form action="recherche_vols.php" method="GET" class="form-container mx-auto">
        <div class="form-group">
            <label for="depart"><?php echo __("departure_city"); ?></label>
            <input type="text" class="form-control" id="depart" name="depart" required>
        </div>
        <div>
            <label for="depart"><?php echo __("departure_city"); ?></label>
            <select name="depart" id="depart">
                <!-- // foreach de tout les airports -->
                 <?php foreach($results as $result) {
                 ?><option><?php foreach($result as $name)
                                        echo $name;?>
                    </option><?php
                 }?>
            </select> 
        </div>
        <div class="form-group">
            <label for="destination"><?php echo __("destination_city"); ?></label>
            <input type="text" class="form-control" id="destination" name="destination" required>
        </div>
        <div class="form-group">
            <label><?php echo __("trip_type"); ?></label><br>
            <input type="radio" name="trip_type" value="one-way" checked onclick="toggleReturnDate()"><?php echo __("one_way"); ?>
            <input type="radio" name="trip_type" value="round-trip" onclick="toggleReturnDate()"><?php echo __("round_trip"); ?>
        </div>
        <div class="form-group">
            <label for="date_depart_start"><?php echo __("departure_date"); ?></label>
            <input type="date" class="form-control" name="date_depart_start" required>
        </div>
        <div class="form-group" id="return-date-group" style="display:none;">
            <label for="date_return"><?php echo __("return_date"); ?></label>
            <input type="date" class="form-control" name="date_return">
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo __("search"); ?></button>
    </form>
    
    <?php if (!empty($results)): ?>
        <h2 class="text-center my-4"><?php echo __("available_flights"); ?></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __("flight_id"); ?></th>
                    <th><?php echo __("departure"); ?></th>
                    <th><?php echo __("destination"); ?></th>
                    <th><?php echo __("departure_date_table"); ?></th>
                    <th><?php echo __("arrival_date"); ?></th>
                    <th><?php echo __("status"); ?></th>
                    <th><?php echo __("action"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $flight): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($flight['id']); ?></td>
                        <td><?php echo htmlspecialchars($flight['departure_airport']); ?></td>
                        <td><?php echo htmlspecialchars($flight['destination_airport']); ?></td>
                        <td><?php echo htmlspecialchars($flight['departure_date']); ?></td>
                        <td><?php echo htmlspecialchars($flight['arrival_date']); ?></td>
                        <td><?php echo htmlspecialchars($flight['status']); ?></td>
                        <td><a href="booking.php?flight_id=<?php echo htmlspecialchars($flight['id']); ?>" class="btn btn-primary"><?php echo __("book"); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && empty($results) && empty($errors)): ?>
        <p class="text-center"><?php echo __("no_flights_found"); ?></p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    function toggleReturnDate() {
        const returnDateGroup = document.getElementById('return-date-group');
        const tripType = document.querySelector('input[name="trip_type"]:checked').value;
        returnDateGroup.style.display = tripType === 'round-trip' ? 'block' : 'none';
    }

    function loadAirports() {
        $.getJSON('get_airports.php', function(data) {
            const airportNames = data.map(airport => `${airport.name} (${airport.code})`);
            
            $("#depart").autocomplete({
                source: airportNames
            });

            $("#destination").autocomplete({
                source: airportNames
            });
        });
    }

    $(document).ready(loadAirports);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>