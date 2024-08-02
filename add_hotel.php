<?php
require 'db.php';
require_once 'translate.php';
$errors = [];
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $available_from = $_POST['available_from'];
    $available_to = $_POST['available_to'];
    $price_per_night = $_POST['price_per_night'];
    $check_in_time = $_POST['check_in_time'];

    // Validation des champs
    if (empty($name) || empty($location) || empty($available_from) || empty($available_to) || empty($price_per_night) || empty($check_in_time)) {
        $errors[] = "Tous les champs sont requis.";
    } else {
        $stmt = $conn->prepare("INSERT INTO hotels (name, location, available_from, available_to, price_per_night, check_in_time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $location, $available_from, $available_to, $price_per_night, $check_in_time);
        if ($stmt->execute()) {
            $success_message = "Hôtel ajouté avec succès.";
        } else {
            $errors[] = "Échec de l'ajout de l'hôtel.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Hôtel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php';?>

    <div class="container mt-5">
        <h1 class="text-center">Ajouter un Hôtel</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <form action="add_hotel.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="name">Nom de l'Hôtel:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="location">Emplacement:</label>
                <input type="text" name="location" class="form-control" id="location" required>
            </div>
            <div class="form-group">
                <label for="available_from">Disponible à partir du:</label>
                <input type="date" name="available_from" class="form-control" id="available_from" required>
            </div>
            <div class="form-group">
                <label for="available_to">Disponible jusqu'au:</label>
                <input type="date" name="available_to" class="form-control" id="available_to" required>
            </div>
            <div class="form-group">
                <label for="price_per_night">Prix par nuit:</label>
                <input type="number" name="price_per_night" class="form-control" id="price_per_night" required>
            </div>
            <div class="form-group">
                <label for="check_in_time">Heure d'arrivée:</label>
                <input type="time" name="check_in_time" class="form-control" id="check_in_time" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>