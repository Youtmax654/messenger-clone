<?php
require "utils/database.php";

if (!isset($_SESSION["userId"])) {
    header('Location: login.php');
}

if (isset($_SESSION["successfulConnection"])) {
    $success = $_SESSION["successfulConnection"];
    unset($_SESSION["successfulConnection"]);
}

$pdo = connectToDbAndGetPDO();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "utils/head.php" ?>
    <title>Messenger</title>
</head>

<body>
    <?php if (isset($success)) {
        echo "  <div class='success'>
                    $success
                    <div class='progress-bar' id='myBar'></div>
                </div>";
    } ?>
    <main>
        <div id="NavBar">
            <div class="nav">
                <i class="fa-solid fa-comment selected"></i>
                <i class="fa-solid fa-address-book"></i>
            </div>
            <img src=<?php include "utils/getUserProfilePicture.php"?> alt='Profile picture' id='Profile'>
            <div id="ProfileMenu" class="hidden">
                <div class="button">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p>Déconnexion</p>
                </div>
                <div class="arrow"></div>
            </div>
        </div>
        <div id="ChatMenu">
            <div class="title">
                <h1>Discussions</h1>
                <i id="NewConversation" class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="searchChat">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchChat" placeholder="Rechercher dans Messenger">
            </div>
            <div class="chatList">
                <div></div>
            </div>
        </div>
        <div id="NoConvOpen" class="">
            <img src="assets/img/messenger.png" alt="Messenger logo">
        </div>
        <div id="NewMessage" class="hidden">
            <form method="POST">
                <p>À :</p>
                <input type="text" id="SendMessageTo">
                <div class="searchResult hidden">
                </div>
            </form>
        </div>
        <div id="Chat" class="hidden">
            <div class="title">
                <img src="assets/img/secondUserPP.jpg" alt="Profile picture" class="profilePicture">
                <p class="username">Octet Coding</p>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <div class="content">
                <img src="assets/img/secondUserPP.jpg" alt="Profile picture" class="profilePicture">
                <h1 class="username">Octet Coding</h1>
                <p class="datetime">04/06/2022 00:00</p>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture" class="profilePicture">
                    <p>Salut ! <img src="assets/img/messenger.png" alt="une image tkt"></p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
            </div>
            <div class="input">
                <i class="fa-regular fa-image"></i>
                <input type="text" placeholder="Aa">
                <i class="fa-solid fa-thumbs-up"></i>
                <i class="fa-solid fa-paper-plane-top hidden"></i>
            </div>
        </div>
    </main>
</body>

</html>