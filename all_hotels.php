<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once 'translate.php';
$errors = [];
$results = [];

// Si une recherche par location est effectuée
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['location'])) {
    $location = trim($_GET['location']);

    // Validation de l'emplacement
    if (empty($location)) {
        $errors[] = "Location is required.";
    }

    if (empty($errors)) {
        // Requête SQL pour rechercher tous les hôtels dans une location spécifique
        $stmt = $conn->prepare("SELECT * FROM hotels WHERE location = ?");
        $stmt->bind_param("s", $location);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
} else {
    // Si aucun emplacement n'est spécifié, affichez tous les hôtels
    $stmt = $conn->prepare("SELECT * FROM hotels");
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("All Hotels"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("All Hotels"); ?></h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>" . __($error) . "</p>";
        }
        echo '</div>';
    }
    ?>
    
    <?php if (!empty($results)): ?>
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
                        <td><a href="book_hotel.php?hotel_id=<?php echo $hotel['id']; ?>" class="btn btn-primary"><?php echo __("Book"); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center"><?php echo __("No hotels found."); ?></p>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>