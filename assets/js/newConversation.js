document.addEventListener('DOMContentLoaded', function () {
    var NewConversationBtn = document.getElementById("NewConversation");
    var listOfChats = document.querySelector("#ChatMenu .chatList");
    var Chat = document.getElementById("Chat");
    var ChatProfilePictures = document.querySelectorAll("#Chat img.profilePicture");
    var ChatUsernames = document.querySelectorAll("#Chat .username");
    var NewMessageTo = document.getElementById("NewMessage");
    var NoConvOpen = document.getElementById("NoConvOpen");
    var InputSendMessageTo = document.getElementById("SendMessageTo");
    var searchResult = document.querySelector("#NewMessage form .searchResult")

    NewConversationBtn.addEventListener("click", function () {
        if (!Chat.classList.contains("hidden")) {
            Chat.classList.add("hidden");
        }
        if (!NoConvOpen.classList.contains("hidden")) {
            NoConvOpen.classList.add("hidden");
        }
        if (NewMessageTo.classList.contains("hidden")) {
            NewMessageTo.classList.remove("hidden");
        }
        if (!listOfChats.firstElementChild.classList.contains("newChat")) {
            var selectedElements = document.querySelectorAll("#ChatMenu .chatList .selected");
            if (selectedElements.length > 0) {
                selectedElements.forEach(function (selectedElement) {
                    selectedElement.classList.remove("selected")
                });
            };

            var div_newChat = document.createElement("div");
            div_newChat.classList.add("newChat", "selected");
            var img = document.createElement("img");
            img.src = "assets/img/NewMessage.png";
            var div_text = document.createElement("div");
            div_text.classList.add("text");
            var h1 = document.createElement("h1");
            h1.textContent = "Nouveau message";
            var xmark = document.createElement("i")
            xmark.classList.add("fa-solid", "fa-xmark", "hidden")
            div_text.appendChild(h1);
            div_newChat.appendChild(img);
            div_newChat.appendChild(div_text);
            div_newChat.appendChild(xmark);
            listOfChats.insertBefore(div_newChat, listOfChats.firstElementChild);

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
                if (!Chat.classList.contains("hidden")) {
                    Chat.classList.add("hidden");
                }
                if (!NewMessageTo.classList.contains("hidden")) {
                    NewMessageTo.classList.add("hidden");
                }
            })
        }
        InputSendMessageTo.focus();
        searchResult.innerHTML = "";
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
        var inputValue = InputSendMessageTo.value;
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
                var users = JSON.parse(xhr.responseText);

                users.forEach(user => {
                    var div_user = document.createElement("div");
                    div_user.classList.add("user");
                    var img = document.createElement("img");
                    img.src = user.profile_picture;
                    var p = document.createElement("p")
                    p.textContent = user.username;
                    div_user.appendChild(img);
                    div_user.appendChild(p);
                    searchResult.appendChild(div_user);

                    div_user.addEventListener("click", function () {
                        NewMessageTo.classList.add("hidden");
                        InputSendMessageTo.value = "";
                        searchResult.innerHTML = "";
                        Chat.classList.remove("hidden");
                        ChatProfilePictures.forEach(ChatProfilePicture => {
                            ChatProfilePicture.src = user.profile_picture;
                        });
                        ChatUsernames.forEach(ChatUsername => {
                            ChatUsername.textContent = user.username;
                            ChatUsername.setAttribute("userId", user.id)
                        });
                    });
                });
            };
        };
    });
})