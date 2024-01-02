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