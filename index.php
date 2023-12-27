<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Messenger Clone</title>
</head>

<body>
    <main>
        <div id="NavBar">
            <div class="nav">
                <i class="fa-solid fa-comment selected"></i>
                <i class="fa-solid fa-address-book"></i>
            </div>
            <img src="assets/img/profilePicture.jpg" alt="Profile picture">
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