<?php
require 'db.php';
require_once 'translate.php';

$stmt = $conn->prepare("INSERT INTO users (`username`, `password`, `email`, `firstname`, `lastname`, `phone`) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $username, $password, $email, $firstname, $lastname, $phone);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash du mot de passe
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];

    // Validation des champs
    if (empty($username) || empty($password) || empty($email) || empty($firstname) || empty($lastname) || empty($phone)) {
        $error_message = "Tous les champs sont requis.";
    } else {
        $stmt->execute();
        header('Location: compte_cree.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Register</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="form-inscription.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" id="password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                            <i class="fa fa-eye" id="eye-password"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="firstname">Prénom:</label>
                <input type="text" name="firstname" class="form-control" id="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Nom:</label>
                <input type="text" name="lastname" class="form-control" id="lastname" required>
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone:</label>
                <input type="text" name="phone" class="form-control" id="phone" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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