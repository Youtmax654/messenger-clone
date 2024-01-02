<?php
header('Content-Type: application/json');

require "database.php";

$pdo = connectToDbAndGetPDO();

if (isset($_POST["searchValue"])) {
    $getUsers = $pdo->prepare("SELECT `id`, `username`, `profile_picture` FROM `users`
                               WHERE username LIKE :searchValue");
    $getUsers->execute([
        ":searchValue" => $_POST["searchValue"] . '%'
    ]);

    $users = $getUsers->fetchAll();
    echo json_encode($users);
}
