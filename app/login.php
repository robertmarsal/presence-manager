<?php
    session_start();

//TODO: validate trough database
$valid_user = true;

if($valid_user){
    $_SESSION['role'] = 'admin'; 
}

header('Location: ../index.php');