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
    $direct_only = isset($_GET['direct_only']) ? true : false; // Ajouter le paramètre pour les vols directs
    $travelers = isset($_GET['travelers']) ? intval($_GET['travelers']) : 1; // Nombre de voyageurs

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
    if ($travelers <= 0) {
        $errors[] = "Number of travelers must be at least 1.";
    }

    if (empty($errors)) {
        // Requête SQL pour rechercher les vols
        $query = "SELECT * FROM vols WHERE departure_airport = ? AND destination_airport = ? AND departure_date = ?";
        if ($direct_only) {
            $query .= " AND direct_flight = 1"; // Filtrer les vols directs
        }
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sss", $depart, $destination, $date_depart_start);
            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $errors[] = "Failed to prepare SQL statement.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search for Flights</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Inclure le fichier CSS ici -->
</head>
<body>
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
            <input type="text" class="form-control" name="depart" name="depart" placeholder="e.g., New York" required>
            
        </div>
        <div class="form-group">
            <label for="destination">Destination City:</label>
            <input type="text" class="form-control" name="destination" name="destination" placeholder="e.g., London" required>
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
        <div class="form-group">
            <label for="travelers">Number of Travelers:</label>
            <select class="form-control" name="travelers" id="travelers" required>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        
        <div class="form-group">
            <input type="checkbox" name="direct_only" id="direct_only">
            <label for="direct_only">Direct Flights Only</label>
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
                        <td><a href="booking.php?flight_id=<?php echo $flight['id']; ?>&travelers=<?php echo $travelers; ?>" class="btn btn-primary">Book</a></td>
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