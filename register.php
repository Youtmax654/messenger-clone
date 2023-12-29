<?php
require "utils/database.php";

if (!empty($_POST["register"])) {
    try {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $emailRegex = "/^[\w.-]+@([\w-]+\.)+[\w-]{2,4}$/";
        $usernameRegex = "/^[a-zA-Z0-9_-]{3,15}$/";
        $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/";
        if (preg_match($emailRegex, $email)) {
            if (preg_match($usernameRegex, $username)) {
                if (preg_match($passwordRegex, $_POST["password"])) {
                    if ($_POST["password"] == $_POST["confirmation"]) {
                        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    } else {
                        throw new Exception("Les mots de passe ne correspondent pas.");
                    }

                    $pdo = connectToDbAndGetPDO();
                    $register = $pdo->prepare("INSERT INTO users (`email`,`username`,`password`)
                                       VALUES (:email, :username, :password)");
                    $register->execute([
                        ":email" => $email,
                        ":username" => $username,
                        ":password" => $password
                    ]);
                    header("Location: login.php");
                    $_SESSION["successfulRegistration"] = "Inscription réussie. Veuillez vous connecter.";
                } else {
                    throw new Exception("Le mot de passe doit contenir au minimum 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial.");
                }
            } else {
                throw new Exception("Le nom d'utilisateur doit avoir au moins 3 caractères et ne peux pas contenir de caratères spéciaux.");
            }
        } else {
            throw new Exception("L'adresse email doit être au format nomprenom@domain.com.");
        }
    } catch (Exception $e) {
        if (strpos($e->getMessage(), "users.email") !== false) {
            $error = "Cette adresse email est déjà utilisée.";
        } elseif (strpos($e->getMessage(), "users.username") !== false) {
            $error = "Ce nom d'utilisateur est déjà utilisé.";
        } else {
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "utils/head.php" ?>
    <title>Inscription</title>
</head>

<body>
    <div class="account">
        <?php if (isset($error)) {
            echo "  <div class='error'>
                    $error
                    <div class='progress-bar' id='myBar'></div>
                </div>";
        } ?>
        <img src="assets/img/messenger.png" alt="Messenger logo">
        <h1>S'inscrire sur Messenger</h1>
        <form method="POST">
            <input type="email" placeholder="Adresse e-mail" name="email">
            <input type="text" placeholder="Nom d'utilisateur" name="username">
            <input type="password" placeholder="Mot de passe" name="password">
            <input type="password" placeholder="Confirmer le mot de passe" name="confirmation">
            <input type="submit" value="Continuer" name="register">
        </form>
        <a href="login.php">Déjà un compte ?</a>
    </div>
</body>

</html>