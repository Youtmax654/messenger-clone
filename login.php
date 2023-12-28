<?php
require "utils/database.php";

if (isset($_SESSION["successfulRegistration"])) {
    $success = $_SESSION["successfulRegistration"];
    unset($_SESSION["successfulRegistration"]);
}

if (!empty($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $pdo = connectToDbAndGetPDO();
    $login = $pdo->prepare("SELECT * FROM users
                            WHERE `email` = :email");
    $login->execute([
        ":email" => $email
    ]);
    $user = $login->fetch(PDO::FETCH_OBJ);
    var_dump($user);
    if ($user !== false) {
        if (password_verify($_POST["password"], $user->password)) {
            $_SESSION["userId"] = $user->id;
            $_SESSION["username"] = $user->username;
            $updateDate = $pdo->prepare('UPDATE users SET last_connection = DEFAULT WHERE id = :id');
            $updateDate->execute([
                ":id" => $_SESSION["userId"]
            ]);
            $_SESSION["successfulConnection"] = "Connexion réussie.";
            header("Location: index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?= require "utils/head.php" ?>
    <title>Connexion</title>
</head>

<body>
    <div class="account">
        <?php if (isset($success)) {
            echo "  <div class='success'>
                    $success
                    <div class='progress-bar' id='myBar'></div>
                </div>";
        } ?>
        <img src="assets/img/messenger.png" alt="Messenger logo">
        <h1>Restez en contact, tout simplement.</h1>
        <form method="POST">
            <input type="email" placeholder="Adresse e-mail" name="email">
            <input type="password" placeholder="Mot de passe" name="password">
            <input type="submit" value="Continuer" name="login">
        </form>
        <a href="register.php">Pas de compte ?</a>
    </div>
</body>

</html>