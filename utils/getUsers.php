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

    // Fetch the results as an associative array
    $users = $getUsers->fetchAll(PDO::FETCH_ASSOC);

    // Clean the data by converting to UTF-8
    array_walk_recursive($users, function (&$value) {
        $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    });

    // Convert the array to JSON
    echo json_encode($users);
}
