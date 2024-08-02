<?php
require 'db.php';
require_once 'translate.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: connection_compte.php');
    exit();
}

$errors = [];
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_SESSION['user_id'];

    // Validation des champs
    if (empty($username)) {
        $errors[] = __("Nom d'utilisateur est requis.");
    }
    if (empty($email)) {
        $errors[] = __("Adresse e-mail est requise.");
    }
    if (empty($firstname)) {
        $errors[] = __("Prénom est requis.");
    }
    if (empty($lastname)) {
        $errors[] = __("Nom est requis.");
    }
    if (empty($phone)) {
        $errors[] = __("Numéro de téléphone est requis.");
    }
    if (!empty($new_password) || !empty($confirm_password)) {
        if (empty($current_password)) {
            $errors[] = __("Mot de passe actuel est requis pour changer le mot de passe.");
        }
        if ($new_password !== $confirm_password) {
            $errors[] = __("Le nouveau mot de passe et la confirmation du mot de passe ne correspondent pas.");
        }
    }

    if (empty($errors)) {
        if (!empty($current_password)) {
            // Vérifier le mot de passe actuel
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->bind_result($stored_password);
            $stmt->fetch();
            $stmt->close();

            if (!password_verify($current_password, $stored_password)) {
                $errors[] = __("Le mot de passe actuel est incorrect.");
            } else {
                // Mettre à jour le mot de passe
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->bind_param('si', $hashed_password, $user_id);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Mettre à jour les informations de l'utilisateur
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, firstname = ?, lastname = ?, phone = ? WHERE id = ?");
        $stmt->bind_param('sssssi', $username, $email, $firstname, $lastname, $phone, $user_id);

        if ($stmt->execute()) {
            $success_message = __("Informations mises à jour avec succès.");
        } else {
            $errors[] = __("Échec de la mise à jour des informations.");
        }
        $stmt->close();
    }
}

// Récupérer les informations de l'utilisateur
$user = [];
$stmt = $conn->prepare("SELECT username, email, firstname, lastname, phone FROM users WHERE id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo __("Votre Compte"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center"><?php echo __("Votre Compte"); ?></h1>

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

        <form action="account.php" method="POST" class="form-container mx-auto" style="max-width: 600px;">
            <div class="form-group">
                <label for="username"><?php echo __("Nom d'utilisateur"); ?>:</label>
                <input type="text" name="username" class="form-control" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><?php echo __("Adresse e-mail"); ?>:</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="firstname"><?php echo __("Prénom"); ?>:</label>
                <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname"><?php echo __("Nom"); ?>:</label>
                <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone"><?php echo __("Numéro de téléphone"); ?>:</label>
                <input type="text" name="phone" class="form-control" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <hr>
            <div class="form-group">
                <label for="current_password"><?php echo __("Mot de passe actuel"); ?>:</label>
                <div class="input-group">
                    <input type="password" name="current_password" class="form-control" id="current_password">
                    <div class="input-group-append">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="new_password"><?php echo __("Nouveau mot de passe"); ?>:</label>
                <div class="input-group">
                    <input type="password" name="new_password" class="form-control" id="new_password">
                    <div class="input-group-append">
                        <span class="input-group-text eye-icon" onclick="togglePasswordVisibility('new_password')">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password"><?php echo __("Confirmer le nouveau mot de passe"); ?>:</label>
                <div class="input-group">
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                    <div class="input-group-append">
                        <span class="input-group-text eye-icon" onclick="togglePasswordVisibility('confirm_password')">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?php echo __("Mettre à jour"); ?></button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function togglePasswordVisibility(id) {
            var field = document.getElementById(id);
            var icon = field.nextElementSibling.querySelector('.fa');
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>