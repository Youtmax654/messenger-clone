document.addEventListener("DOMContentLoaded", function () {
    setInterval(refreshListOfChats, 100);
    setInterval(refreshChatMessages, 100);
    var currentMessages = [];

    function refreshListOfChats() {
        var NoConvOpen = document.getElementById("NoConvOpen");
        var NewMessageTo = document.getElementById("NewMessage");
        var Chat = document.getElementById("Chat");
        var ChatProfilePictures = document.querySelectorAll("#Chat img.profilePicture");
        var ChatUsernames = document.querySelectorAll("#Chat .username");
        var listOfChats = document.querySelector("#ChatMenu .chatList");

        var xhr = new XMLHttpRequest();
        var url = "utils/getChat.php";
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var newMessages = JSON.parse(xhr.responseText);
                if (JSON.stringify(newMessages) !== JSON.stringify(currentMessages)) {
                    currentMessages = newMessages;

                    listOfChats.innerHTML = "";
                    newMessages.forEach(message => {
                        var div_chatSelection = document.createElement("div");
                        div_chatSelection.classList.add("chatSelection");
                        var img = document.createElement("img");
                        img.src = message.profile_picture;
                        var div_text = document.createElement("div");
                        div_text.classList.add("text");
                        var h1 = document.createElement("h1");
                        h1.textContent = message.username;
                        var p = document.createElement("p");
                        if (message.is_sender === "1") {
                            p.textContent = "Vous: " + message.content;
                        } else {
                            p.textContent = message.content;
                        }
                        div_text.appendChild(h1);
                        div_text.appendChild(p);
                        div_chatSelection.appendChild(img);
                        div_chatSelection.appendChild(div_text);
                        listOfChats.appendChild(div_chatSelection);

                        div_chatSelection.addEventListener("click", function () {
                            var selectedElements = document.querySelectorAll("#ChatMenu .chatList .selected");
                            if (selectedElements.length > 0) {
                                selectedElements.forEach(function (selectedElement) {
                                    selectedElement.classList.remove("selected")
                                });
                            };
                            NoConvOpen.classList.add("hidden");
                            NewMessageTo.classList.add("hidden");
                            Chat.classList.remove("hidden");
                            div_chatSelection.classList.add("selected");
                            ChatProfilePictures.forEach(ChatProfilePicture => {
                                ChatProfilePicture.src = message.profile_picture;
                            });
                            ChatUsernames.forEach(ChatUsername => {
                                ChatUsername.textContent = message.username;
                                ChatUsername.setAttribute("userId", message.other_user_id);
                            });
                        });
                    });
                };
            };
        };
        xhr.send();
    };

    var currentChat = [];

    function refreshChatMessages() {
        var ChatUsername = document.querySelector("#Chat .username");
        var chatWith = ChatUsername.getAttribute("userid");
        var ChatContent = document.querySelector("#Chat .content");
        var ChatMessages = document.querySelector("#Chat .content .messages");

        var xhr = new XMLHttpRequest();
        var url = "utils/chat.php";
        var params = "chatWith=" + encodeURIComponent(chatWith);
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var newChat = JSON.parse(xhr.responseText);
                if (JSON.stringify(newChat) !== JSON.stringify(currentChat)) {
                    currentChat = newChat;

                    ChatMessages.innerHTML = "";
                    newChat.forEach(message => {
                        if (message.sender_id === chatWith) {
                            var div_leftMessage = document.createElement("div");
                            div_leftMessage.classList.add("leftMessage");
                            var img = document.createElement("img");
                            img.src = message.profile_picture;
                            img.classList.add("profilePicture");
                            var p = document.createElement("p");
                            p.textContent = message.content;
                            div_leftMessage.appendChild(img);
                            div_leftMessage.appendChild(p);
                            ChatMessages.appendChild(div_leftMessage);
                        } else {
                            var div_rightMessage = document.createElement("div");
                            div_rightMessage.classList.add("rightMessage");
                            var p = document.createElement("p");
                            p.textContent = message.content;
                            div_rightMessage.appendChild(p);
                            ChatMessages.appendChild(div_rightMessage);
                        }
                    })
                    ChatContent.scrollTop = ChatContent.scrollHeight;
                }
            }
        }
        xhr.send(params);
    }

    var ChatInput = document.querySelector("#Chat .input input");
    var PokeBtn = document.querySelector("#Chat .input .fa-thumbs-up");
    var SendBtn = document.querySelector("#Chat .input .fa-paper-plane-top")

    ChatInput.addEventListener("keyup", function (event) {
        PokeBtn.classList.add("hidden");
        SendBtn.classList.remove("hidden");
        if (event.key === "Enter") {
            SendBtn.click();
        }
        if (ChatInput.value === "") {
            PokeBtn.classList.remove("hidden");
            SendBtn.classList.add("hidden");
        }
    })

    SendBtn.addEventListener("click", send);

    function send() {
        var getReceiverUserId = document.querySelector("#Chat .title .username").getAttribute("userid");
        var xhr = new XMLHttpRequest();
        var url = "utils/chat.php";
        var params = "message=" + encodeURIComponent(ChatInput.value) + "&receiverId=" + encodeURIComponent(getReceiverUserId);
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
        ChatInput.value = "";
        PokeBtn.classList.remove("hidden");
        SendBtn.classList.add("hidden");
    };
})