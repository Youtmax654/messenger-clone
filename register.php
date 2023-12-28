<?php
require "utils/database.php";

if (!empty($_POST["register"])) {
    try {
        $email = $_POST["email"];
        $username = $_POST["username"];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/account.css">
    <script src="assets/js/hidePopup.js"></script>
    <title>Inscription</title>
</head>

<body>
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
</body>

</html>