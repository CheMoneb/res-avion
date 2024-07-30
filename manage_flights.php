<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';
$errors = [];
$success = '';

// Suppression d'un vol
if (isset($_POST['delete_flight'])) {
    $flight_id = $_POST['flight_id'];
    $stmt = $conn->prepare("DELETE FROM flights WHERE id = ?");
    $stmt->bind_param("i", $flight_id);
    if ($stmt->execute()) {
        $success = "Flight deleted successfully!";
    } else {
        $errors[] = "Failed to delete flight.";
    }
    $stmt->close();
}

// Mise à jour d'un vol
if (isset($_POST['update_flight'])) {
    $flight_id = $_POST['flight_id'];
    $departure_airport = trim($_POST['departure_airport']);
    $destination_airport = trim($_POST['destination_airport']);
    $departure_date = trim($_POST['departure_date']);
    $arrival_date = trim($_POST['arrival_date']);
    $direct_flight = isset($_POST['direct_flight']) ? 1 : 0;
    $status = trim($_POST['status']);

    if (empty($departure_airport) || empty($destination_airport) || empty($departure_date) || empty($arrival_date) || empty($status)) {
        $errors[] = "All fields are required.";
    } else {
        $stmt = $conn->prepare("UPDATE flights SET departure_airport = ?, destination_airport = ?, departure_date = ?, arrival_date = ?, direct_flight = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssssii", $departure_airport, $destination_airport, $departure_date, $arrival_date, $direct_flight, $status, $flight_id);
        if ($stmt->execute()) {
            $success = "Flight updated successfully!";
        } else {
            $errors[] = "Failed to update flight.";
        }
        $stmt->close();
    }
}

// Requête SQL pour récupérer les vols
$query = "SELECT * FROM flights";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $errors[] = "Failed to prepare SQL statement.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Flights</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4">Manage Flights</h1>
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Departure Airport</th>
                <th>Destination Airport</th>
                <th>Departure Date</th>
                <th>Arrival Date</th>
                <th>Direct Flight</th>
                <th>Status</th>
                <th>Actions</th>
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
                    <td><?php echo $flight['direct_flight'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $flight['status']; ?></td>
                    <td>
                        <form action="manage_flights.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                            <button type="submit" name="delete_flight" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editFlightModal<?php echo $flight['id']; ?>">Edit</button>
                    </td>
                </tr>

                <!-- Modal for Editing Flight -->
                <div class="modal fade" id="editFlightModal<?php echo $flight['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editFlightModalLabel<?php echo $flight['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFlightModalLabel<?php echo $flight['id']; ?>">Edit Flight</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="manage_flights.php" method="post">
                                    <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                                    <div class="form-group">
                                        <label for="departure_airport">Departure Airport:</label>
                                        <input type="text" class="form-control" id="departure_airport" name="departure_airport" value="<?php echo $flight['departure_airport']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="destination_airport">Destination Airport:</label>
                                        <input type="text" class="form-control" id="destination_airport" name="destination_airport" value="<?php echo $flight['destination_airport']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="departure_date">Departure Date:</label>
                                        <input type="date" class="form-control" id="departure_date" name="departure_date" value="<?php echo $flight['departure_date']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="arrival_date">Arrival Date:</label>
                                        <input type="date" class="form-control" id="arrival_date" name="arrival_date" value="<?php echo $flight['arrival_date']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $flight['status']; ?>" required>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="direct_flight" name="direct_flight" <?php echo $flight['direct_flight'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="direct_flight">Direct Flight</label>
                                    </div>
                                    <button type="submit" name="update_flight" class="btn btn-primary">Update Flight</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>