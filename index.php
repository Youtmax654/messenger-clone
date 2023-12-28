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
            <img src="assets/img/profilePicture.jpg" alt="Profile picture" id="Profile">
            <div id="ProfileMenu" class="hidden">
                <div class="button">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <a href="utils/disconnect.php">Déconnexion</a>
                </div>
                <div class="arrow"></div>
            </div>
        </div>
        <div id="ChatMenu">
            <div class="title">
                <h1>Discussions</h1>
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="searchChat">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchChat" placeholder="Rechercher dans Messenger">
            </div>
            <div class="chatList">
                <div class="chatSelection selected">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <div class="text">
                        <h1>Octet Coding</h1>
                        <p>Dernier message - 1 ans</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="ContactMenu">

        </div>
        <div id="chat">

        </div> -->
        <div id="Chat">
            <div class="title">
                <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                <p>Octet Coding</p>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <div class="content">
                <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                <h1>Octet Coding</h1>
                <p class="datetime">04/06/2022 00:00</p>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="leftMessage">
                    <img src="assets/img/secondUserPP.jpg" alt="Profile picture">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>!</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
                <div class="rightMessage">
                    <p>Salut !</p>
                </div>
            </div>
            <div class="input">
                <i class="fa-regular fa-image"></i>
                <input type="text" placeholder="Aa">
                <p>🐋</p>
            </div>
        </div>
    </main>
</body>

</html>