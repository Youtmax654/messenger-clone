<?php 
function connectToDbAndGetPDO() {
    $hostname = "localhost";
    $dbname = "messenger_clone";
    $user = "root";
    $pass = "";

    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
    return $pdo;
}

session_start();