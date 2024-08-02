<?php
require 'db.php';
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $errors[] = __("Adresse e-mail est requise.");
    } else {
        // Check if the email exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            // Generate a unique token
            $token = bin2hex(random_bytes(50));
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
            $stmt->bind_param('ss', $token, $email);
            $stmt->execute();

            // Send the email
            $reset_link = "http://yourwebsite.com/password_reset.php?token=" . $token;
            $subject = __("Réinitialisation de votre mot de passe");
            $message = __("Cliquez sur le lien suivant pour réinitialiser votre mot de passe : ") . $reset_link;
            $headers = 'From: no-reply@yourwebsite.com' . "\r\n" .
                        'Reply-To: no-reply@yourwebsite.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

            if (mail($email, $subject, $message, $headers)) {
                $success_message = __("Un e-mail de réinitialisation a été envoyé à votre adresse e-mail.");
            } else {
                $errors[] = __("Erreur lors de l'envoi de l'e-mail.");
            }
        } else {
            $errors[] = __("Aucun compte trouvé avec cette adresse e-mail.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Réinitialiser le mot de passe"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center"><?php echo __("Réinitialiser le mot de passe"); ?></h1>

        <?php
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo '</div>';
        }

        if (!empty($success_message)) {
            echo '<div class="alert alert-success">';
            echo "<p>$success_message</p>";
            echo '</div>';
        }
        ?>

        <form action="password_reset_request.php" method="post" class="form-container mx-auto" style="max-width: 600px;">
            <div class="form-group">
                <label for="email"><?php echo __("Adresse e-mail"); ?>:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?php echo __("Envoyer"); ?></button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>