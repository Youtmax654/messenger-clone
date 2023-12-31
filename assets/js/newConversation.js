document.addEventListener('DOMContentLoaded', function () {
    var NewConversationBtn = document.getElementById("NewConversation");
    var listOfChats = document.querySelector("#ChatMenu .chatList");
    var selectedElements = document.querySelectorAll("#ChatMenu .chatList .selected");
    var Chat = document.getElementById("Chat");
    var NewMessageTo = document.getElementById("NewMessage");
    var NoConvOpen = document.getElementById("NoConvOpen");
    var InputSendMessageTo = document.getElementById("SendMessageTo");
    var searchResult = document.querySelector("#NewMessage form .searchResult")

    NewConversationBtn.addEventListener("click", function () {
        if (!listOfChats.firstElementChild.classList.contains("newChat")) {
            if (selectedElements.length > 0) {
                selectedElements.forEach(function (selectedElement) {
                    selectedElement.classList.remove("selected")
                });
            };

            let div_newChat = document.createElement("div");
            div_newChat.classList.add("newChat", "selected");
            let img = document.createElement("img");
            img.src = "assets/img/NewMessage.png";
            let div_text = document.createElement("div");
            div_text.classList.add("text");
            let h1 = document.createElement("h1");
            h1.textContent = "Nouveau message";
            let xmark = document.createElement("i")
            xmark.classList.add("fa-solid", "fa-xmark", "hidden")
            div_text.appendChild(h1);
            div_newChat.appendChild(img);
            div_newChat.appendChild(div_text);
            div_newChat.appendChild(xmark);
            listOfChats.insertBefore(div_newChat, listOfChats.firstElementChild);

            if (!Chat.classList.contains("hidden")) {
                Chat.classList.add("hidden");
            }
            if (!NoConvOpen.classList.contains("hidden")) {
                NoConvOpen.classList.add("hidden");
            }
            if (NewMessageTo.classList.contains("hidden")) {
                NewMessageTo.classList.remove("hidden");
            }
            div_newChat.addEventListener("mouseenter", function () {
                xmark.classList.remove("hidden");
            })
            div_newChat.addEventListener("mouseleave", function () {
                xmark.classList.add("hidden");
            })
            xmark.addEventListener("click", function () {
                div_newChat.remove();
                NewMessageTo.classList.add("hidden");
                NoConvOpen.classList.remove("hidden");
                InputSendMessageTo.value = "";
            })
        }
        InputSendMessageTo.focus();
    });

    function showSearchResult() {
        if (searchResult.classList.contains("hidden")) {
            searchResult.classList.remove("hidden");
        }
    }
    function hideSearchResult() {
        if (!searchResult.classList.contains("hidden")) {
            searchResult.classList.add("hidden");
        }
    }
    InputSendMessageTo.addEventListener("focus", showSearchResult);
    searchResult.addEventListener("mousedown", function (event) {
        event.stopPropagation();
    });
    InputSendMessageTo.addEventListener("mousedown", function (event) {
        event.stopPropagation();
    });
    document.addEventListener("mousedown", function () {
        hideSearchResult();
    });

    InputSendMessageTo.addEventListener("keyup", function () {
        searchResult.innerHTML = "";
        inputValue = InputSendMessageTo.value;
        var xhr = new XMLHttpRequest();
        var url = "utils/getUsers.php";
        var params = "searchValue=" + inputValue;
        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
            }
        };

        xhr.send(params);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Traitement des données reçues de PHP
                var responseData = JSON.parse(xhr.responseText);
                // Utilisez la méthode map pour extraire les noms d'utilisateurs
                var IDs = responseData.map(function (user) {
                    return user.id;
                })
                var usernames = responseData.map(function (user) {
                    return user.username;
                });
                var profilesPicture = responseData.map(function (user) {
                    return user.profile_picture;
                });

                if (InputSendMessageTo.value === "") {
                    searchResult.removeChild();
                }
                
                IDs.forEach(id => {
                    var index = IDs.indexOf(id);
                    div_user = document.createElement("div");
                    div_user.classList.add("user");
                    img = document.createElement("img");
                    img.src = profilesPicture;
                    p = document.createElement("p")
                    p.textContent = usernames[index];
                    div_user.appendChild(img);
                    div_user.appendChild(p);
                    searchResult.appendChild(div_user);
                });

                // Maintenant, la variable "usernames" contient un array de noms d'utilisateurs
                console.log(IDs);
                console.log(usernames);
                console.log(profilesPicture);
            };
        };
    });
})