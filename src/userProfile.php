<?php

include_once 'tools.php';

$database = new Database();
$tests = $database->getCategories();