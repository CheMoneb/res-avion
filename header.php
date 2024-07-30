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

function getFlag($lang) {
    switch ($lang) {
        case 'en':
            return '/images/us.png';
        case 'fr':
            return '/images/fr.png';
        case 'es':
            return '/images/es.png';
        case 'it':
            return '/images/it.png';
        case 'ar':
            return '/images/sa.png';
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Airbooker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><?php echo __("Home"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recherche_vols.php"><?php echo __("Search Flights"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="booking.php"><?php echo __("Bookings"); ?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="vacationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo __("Vacations"); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="vacationsDropdown">
                    <a class="dropdown-item" href="hotels.php"><?php echo __("Hotels"); ?></a>
                    <a class="dropdown-item" href="car_rental.php"><?php echo __("Car Rental"); ?></a>
                    <a class="dropdown-item" href="transport.php"><?php echo __("Transport"); ?></a>
                    <a class="dropdown-item" href="travel_ideas.php"><?php echo __("Travel Ideas"); ?></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo getFlag($lang); ?>" alt="Language" class="flag-icon">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <form method="post" id="langForm">
                        <button type="submit" name="lang" value="en" class="dropdown-item">
                            <img src="/images/us.png" alt="English" class="flag-icon"> English
                        </button>
                        <button type="submit" name="lang" value="fr" class="dropdown-item">
                            <img src="/images/fr.png" alt="Français" class="flag-icon"> Français
                        </button>
                        <button type="submit" name="lang" value="es" class="dropdown-item">
                            <img src="/images/es.png" alt="Español" class="flag-icon"> Español
                        </button>
                        <button type="submit" name="lang" value="it" class="dropdown-item">
                            <img src="/images/it.png" alt="Italiano" class="flag-icon"> Italiano
                        </button>
                        <button type="submit" name="lang" value="ar" class="dropdown-item">
                            <img src="/images/sa.png" alt="العربية" class="flag-icon"> العربية
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>