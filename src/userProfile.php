<?php

include_once 'tools.php';

$database = new Database();
$tests = $database->getCategories();
$username = $database->getUsername($_SESSION['user_id']);