<?php
session_start();

include('src/tools.php');

//(new Database())->removeDevice($_SESSION['user_id']);

if(session_destroy())
{
    header("Location: index.php");
}
