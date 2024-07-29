<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données

$errors = [];
$results = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['depart'], $_GET['destination'], $_GET['date_depart_start'], $_GET['trip_type'])) {
    $depart = trim($_GET['depart']);
    $destination = trim($_GET['destination']);
    $date_depart_start = trim($_GET['date_depart_start']);
    $trip_type = trim($_GET['trip_type']);
    $date_return = isset($_GET['date_return']) ? trim($_GET['date_return']) : null;

    // Validation des données du formulaire
    if (empty($depart)) {
        $errors[] = "Departure City is required.";
    }
    if (empty($destination)) {
        $errors[] = "Destination City is required.";
    }
    if (empty($date_depart_start)) {
        $errors[] = "Departure Date is required.";
    }
    if ($trip_type == 'round-trip' && empty($date_return)) {
        $errors[] = "Return Date is required for round-trip.";
    }

    if (empty($errors)) {
        // Requête SQL pour rechercher les vols
        $stmt = $conn->prepare("SELECT * FROM flights WHERE departure_airport = ? AND destination_airport = ? AND departure_date = ?");
        $stmt->bind_param("sss", $depart, $destination, $date_depart_start);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4">Search for Flights</h1>
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
            <label for="depart">Departure City:</label>
            <input type="text" class="form-control" name="depart" required>
        </div>
        <div class="form-group">
            <label for="destination">Destination City:</label>
            <input type="text" class="form-control" name="destination" required>
        </div>
        <div class="form-group">
            <label>Trip Type:</label><br>
            <input type="radio" name="trip_type" value="one-way" checked onclick="toggleReturnDate()"> One-way
            <input type="radio" name="trip_type" value="round-trip" onclick="toggleReturnDate()"> Round-trip
        </div>
        <div class="form-group">
            <label for="date_depart_start">Departure Date:</label>
            <input type="date" class="form-control" name="date_depart_start" required>
        </div>
        <div class="form-group" id="return-date-group" style="display:none;">
            <label for="date_return">Return Date:</label>
            <input type="date" class="form-control" name="date_return">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Search</button>
    </form>
    
    <?php if (!empty($results)): ?>
        <h2 class="text-center my-4">Available Flights</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Flight ID</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Status</th>
                    <th>Action</th>
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
                        <td><a href="booking.php?flight_id=<?php echo $flight['id']; ?>" class="btn btn-primary">Book</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && empty($results) && empty($errors)): ?>
        <p class="text-center">No flights found.</p>
    <?php endif; ?>
</div>

<script>
    function toggleReturnDate() {
        const returnDateGroup = document.getElementById('return-date-group');
        const tripType = document.querySelector('input[name="trip_type"]:checked').value;
        returnDateGroup.style.display = tripType === 'round-trip' ? 'block' : 'none';
    }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>