<?php
require_once 'db.php';
require_once 'translate.php';
$errors = [];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .footer-clean {
            background-color: #f8f9fa;
            padding: 40px 0;
            color: #333;
        }

        .footer-clean h3 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .footer-clean ul {
            list-style: none;
            padding: 0;
        }

        .footer-clean ul li {
            margin-bottom: 10px;
        }

        .footer-clean ul li a {
            color: #343a40;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-clean ul li a:hover {
            color: #007bff;
        }

        .footer-clean .item.social a {
            font-size: 24px;
            margin: 0 10px;
            color: #343a40;
            transition: color 0.2s;
        }

        .footer-clean .item.social a:hover {
            color: #007bff;
        }

        .footer-clean .copyright {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-flex">
        <div class="content">
            <!-- Votre contenu ici -->
        </div>
    </div>

    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3><?php echo __("quick_links"); ?></h3>
                        <ul>
                            <li><a href="#"><?php echo __("book_a_flight"); ?></a></li>
                            <li><a href="#"><?php echo __("manage_booking"); ?></a></li>
                            <li><a href="#"><?php echo __("flight_status"); ?></a></li>
                            <li><a href="#"><?php echo __("customer_support"); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3><?php echo __("about"); ?></h3>
                        <ul>
                            <li><a href="#"><?php echo __("about_us"); ?></a></li>
                            <li><a href="#"><?php echo __("careers"); ?></a></li>
                            <li><a href="#"><?php echo __("press"); ?></a></li>
                            <li><a href="#"><?php echo __("blog"); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3><?php echo __("policies"); ?></h3>
                        <ul>
                            <li><a href="#"><?php echo __("privacy_policy"); ?></a></li>
                            <li><a href="#"><?php echo __("terms_of_use"); ?></a></li>
                            <li><a href="#"><?php echo __("cookie_policy"); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social">
                        <h3><?php echo __("follow_us"); ?></h3>
                        <a href="https://facebook.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-twitter"></i></a>
                        <a href="https://snapchat.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-snapchat"></i></a>
                        <a href="https://instagram.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-instagram"></i></a>
                        <a href="https://linkedin.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-linkedin"></i></a>
                        <a href="https://github.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-github"></i></a>
                        <a href="https://youtube.com" class="text-dark mr-3" style="font-size: 24px;"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <p class="copyright">Airbooker © 2024</p>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>