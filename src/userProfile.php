<?php

include_once 'tools.php';

$database = new Database();

if($database->getUserRole($_SESSION['user_id']) == 1) {
    header("Location: employer-profile.php");
}
$tests = $database->getCategories();
$username = $database->getUsername($_SESSION['user_id']);
$stanowisko = $database->getStanowisko($_SESSION['user_id']);
