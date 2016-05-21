<?php

function randStrGen($len){
    $result = "";
    $chars = 'abcdefghijklmnopqrstuvwxyz$_?!-0123456789';
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
        $randItem = array_rand($charArray);
        $result .= "".$charArray[$randItem];
    }
    return $result;
}

include_once "class/DataPreferences.php";
include_once "class/User.php";
include_once "class/UserData.php";
include_once "class/Database.php";
include_once "class/UserAccount.php";