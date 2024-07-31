<?php
require_once 'translate.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("special_offers"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        
        .offer {
            margin-bottom: 30px;
        }
        .offer img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .offer img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .offer h3 {
            margin-top: 15px;
            font-weight: bold;
        }
        .offer p {
            margin-top: 10px;
        }
        .offer .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container offers-container">
        <h1 class="text-center"><?php echo __("special_offers"); ?></h1>

        <h2 class="mt-5"><?php echo __("travel_offers"); ?></h2>
        <div class="row">
            <div class="col-md-4 offer">
                <img src="images/los angeles.png" alt="<?php echo __("Los Angeles"); ?>">
                <h3><?php echo __("Los Angeles"); ?></h3>
                <p><?php echo __("travel_offer1_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
            <div class="col-md-4 offer">
                <img src="images/New York.jpg" alt="<?php echo __("New York"); ?>">
                <h3><?php echo __("New York"); ?></h3>
                <p><?php echo __("Venez decouvrir l'Etat de New York!"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
            <div class="col-md-4 offer">
                <img src="images/Espagne.jpg" alt="<?php echo __("Espagne"); ?>">
                <h3><?php echo __("Espagne"); ?></h3>
                <p><?php echo __("travel_offer3_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
        </div>

        <h2 class="mt-5"><?php echo __("hotel_offers"); ?></h2>
        <div class="row">
            <div class="col-md-4 offer">
                <img src="images/porto.jpg" alt="<?php echo __("Portugal"); ?>">
                <h3><?php echo __("Portugal"); ?></h3>
                <p><?php echo __("hotel_offer1_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
            <div class="col-md-4 offer">
                <img src="images/Sousse.jpg" alt="<?php echo __("Tunisie"); ?>">
                <h3><?php echo __("Tunisie"); ?></h3>
                <p><?php echo __("hotel_offer2_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
            <div class="col-md-4 offer">
                <img src="images/Grèce.jpg" alt="<?php echo __("Grèce"); ?>">
                <h3><?php echo __("Grèce"); ?></h3>
                <p><?php echo __("hotel_offer3_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
        </div>

        <h2 class="mt-5"><?php echo __("best_destinations"); ?></h2>
        <div class="row">
            <div class="col-md-4 offer">
                <img src="images/Suisse.jpg" alt="<?php echo __("Suisse"); ?>">
                <h3><?php echo __("Suisse"); ?></h3>
                <p><?php echo __("destination1_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
            <div class="col-md-4 offer">
                <img src="images/Norvege.jpg" alt="<?php echo __("Norvège"); ?>">
                <h3><?php echo __("Norvège"); ?></h3>
                <p><?php echo __("destination2_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
            <div class="col-md-4 offer">
                <img src="images/Thailande.jpg" alt="<?php echo __("Thailand"); ?>">
                <h3><?php echo __("Thailand"); ?></h3>
                <p><?php echo __("destination3_description"); ?></p>
                <a href="#" class="btn btn-primary"><?php echo __("learn_more"); ?></a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>