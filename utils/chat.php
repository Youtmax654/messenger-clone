<?php 
require "database.php";

$pdo = connectToDbAndGetPDO();

if (isset($_POST["message"]) && isset($_POST["receiverId"])) {
    $messageContent = $_POST["message"];
    $NewMessage = $pdo->prepare("INSERT INTO messages (`sender_id`,`receiver_id`,`content`)
                                 VALUES (:sender_id, :receiver_id, :content)");
    $NewMessage->execute([
        ":sender_id" => $_SESSION["userId"],
        ":receiver_id" => $_POST["receiverId"],
        ":content" => $_POST["message"],
    ]);
} 
elseif (isset($_POST["chatWith"])) {
    $chatWith = $_POST["chatWith"];
    $getMessages = $pdo->prepare("SELECT sender_id, content, users.profile_picture FROM messages
                                  INNER JOIN users ON sender_id = users.id
                                  WHERE (sender_id = :chatWith AND receiver_id = :connectedUser) 
                                  OR (sender_id = :connectedUser AND receiver_id = :chatWith)
                                  ORDER BY send_date ASC");
    $getMessages->execute([
        ":chatWith" => $chatWith,
        ":connectedUser" => $_SESSION["userId"],
    ]);
    $messages = $getMessages->fetchAll();

    echo json_encode($messages);
}