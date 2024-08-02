<?php
require 'db.php';
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // Validation des champs
    if (empty($username)) {
        $errors[] = "Nom d'utilisateur est requis.";
    }
    if (empty($password)) {
        $errors[] = "Mot de passe est requis.";
    }
    if (empty($email)) {
        $errors[] = "Adresse e-mail est requise.";
    }

    if (empty($errors)) {
        $query = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `email` = ?");
        $query->bind_param('ss', $username, $email);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();
        
        if (!$user || !password_verify($password, $user['password'])) {
            $errors[] = "Nom d'utilisateur, mot de passe ou adresse e-mail incorrect.";
            $errors[] = "Si vous avez oublié votre mot de passe, vous pouvez le réinitialiser en cliquant <a href='password_reset_request.php'>ici</a>.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            header('location:booking.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'inclure votre fichier CSS global -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="text-center my-4">Login</h1>
        <?php
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo '</div>';
        }
        ?>
        <form action="connection_compte.php" method="post" class="form-container mx-auto" style="max-width: 600px;">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                            <i class="fa fa-eye" id="eye-password"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById('eye-password');
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>