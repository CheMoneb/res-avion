<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$lang = $_SESSION['lang'] ?? 'en';
require_once 'translate.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("customer_support"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .support-section {
            padding: 20px;
        }
        .support-icon {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 15px;
        }
        .support-card {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
        }
        .support-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center"><?php echo __("customer_support"); ?></h1>
        <div class="row support-section">
            <div class="col-md-4 text-center">
                <div class="support-card">
                    <i class="fas fa-comments support-icon"></i>
                    <h5><?php echo __("chat_with_us"); ?></h5>
                    <p><?php echo __("Get instant support through our live chat service."); ?></p>
                    <a href="chat.php" class="btn btn-custom"><?php echo __("chat_with_us"); ?></a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="support-card">
                    <i class="fas fa-envelope support-icon"></i>
                    <h5><?php echo __("email_us"); ?></h5>
                    <p><?php echo __("Send us an email and we will get back to you within 24 hours."); ?></p>
                    <a href="mailto:support@airbooker.com" class="btn btn-custom"><?php echo __("email_us"); ?></a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="support-card">
                    <i class="fas fa-phone support-icon"></i>
                    <h5><?php echo __("call_us"); ?></h5>
                    <p><?php echo __("Reach out to our support team via phone."); ?></p>
                    <a href="tel:+1234567890" class="btn btn-custom"><?php echo __("call_us"); ?></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary"><?php echo __("back_to_home"); ?></a>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>