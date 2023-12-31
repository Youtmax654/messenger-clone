<?php

if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];

    $getImage = $pdo->prepare("SELECT `profile_picture` FROM `users` 
                               WHERE `id` = :userId");
    $getImage->execute([
        ":userId" => $userId
    ]);
    $image = $getImage->fetch();

    echo $image['profile_picture'];
}
