<?php
require "database.php";

$pdo = connectToDbAndGetPDO();

$getChatList = $pdo->prepare("WITH RankedMessages AS ( SELECT content, send_date,
                              CASE WHEN sender_id = :userId THEN receiver_id ELSE sender_id END AS other_user_id,
                              CASE WHEN sender_id = :userId THEN TRUE ELSE FALSE END AS is_sender,
                              ROW_NUMBER() OVER (PARTITION BY CASE WHEN sender_id = :userId THEN receiver_id ELSE sender_id END ORDER BY send_date DESC) AS rnk
                              FROM messages WHERE sender_id = :userId OR receiver_id = :userId )

                              SELECT content, send_date, other_user_id, is_sender, u.username, u.profile_picture
                              FROM RankedMessages 
                              INNER JOIN users AS u ON other_user_id = u.id
                              WHERE rnk = :userId
                              ORDER BY send_date DESC");
$getChatList->execute([
    ":userId" => $_SESSION["userId"],
]);
$chatList = $getChatList->fetchAll();

echo json_encode($chatList);