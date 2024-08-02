<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$lang = $_SESSION['lang'] ?? 'en';

if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];
    $_SESSION['lang'] = $lang;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

require_once 'translate.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("title"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .flag-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
        .navbar-nav .nav-link {
            font-size: 0.85rem; /* Réduit la taille de la police des éléments du menu */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Airbooker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><?php echo __("home"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recherche_vols.php"><?php echo __("Flights"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="booking.php"><?php echo __("bookings"); ?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="vacationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo __("vacations"); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="vacationsDropdown">
                    <a class="dropdown-item" href="hotels.php"><?php echo __("hotels"); ?></a>
                    <a class="dropdown-item" href="car_rental.php"><?php echo __("car_rental"); ?></a>
                    <a class="dropdown-item" href="transport.php"><?php echo __("transport"); ?></a>
                    <a class="dropdown-item" href="travel_ideas.php"><?php echo __("travel_ideas"); ?></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="manageFlightsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo __("manage_flights"); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="manageFlightsDropdown">
                    <a class="dropdown-item" href="manage_flights.php"><?php echo __("manage_flights"); ?></a>
                    <a class="dropdown-item" href="add_flight.php"><?php echo __("add_flight"); ?></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="manageHotelsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo __("manage_hotels"); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="manageHotelsDropdown">
                    <a class="dropdown-item" href="manage_hotels.php"><?php echo __("manage_hotels"); ?></a>
                    <a class="dropdown-item" href="add_hotel.php"><?php echo __("add_hotel"); ?></a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="promotions.php"><?php echo __("Promotion"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="support.php"><?php echo __("customer_support"); ?></a>
            </li>
            <?php if(empty($_SESSION['user_id'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="connection_compte.php"><?php echo __("login"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form-inscription.php"><?php echo __("register"); ?></a>
            </li>
            <?php } else { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo htmlspecialchars($_SESSION['firstname']) . ' ' . htmlspecialchars($_SESSION['lastname']); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="account.php"><?php echo __("your_account"); ?></a>
                    <a class="dropdown-item" href="ma_reservation.php"><?php echo __("my_reservations"); ?></a>
                    <a class="dropdown-item" href="help.php"><?php echo __("help"); ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deconnection.php"><?php echo __("logout"); ?></a>
                </div>
            </li>
            <?php } ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/images/<?php echo $lang; ?>.png" alt="Language" class="flag-icon">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <form method="post" id="langForm">
                        <button type="submit" name="lang" value="en" class="dropdown-item">
                            <img src="/images/en.png" alt="English" class="flag-icon">
                        </button>
                        <button type="submit" name="lang" value="fr" class="dropdown-item">
                            <img src="/images/fr.png" alt="Français" class="flag-icon">
                        </button>
                        <button type="submit" name="lang" value="es" class="dropdown-item">
                            <img src="/images/es.png" alt="Español" class="flag-icon">
                        </button>
                        <button type="submit" name="lang" value="it" class="dropdown-item">
                            <img src="/images/it.png" alt="Italiano" class="flag-icon">
                        </button>
                        <button type="submit" name="lang" value="ar" class="dropdown-item">
                            <img src="/images/ar.png" alt="العربية" class="flag-icon">
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>