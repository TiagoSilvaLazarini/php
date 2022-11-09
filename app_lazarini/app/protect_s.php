<?php

if(!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['id'])) {
    header("location:../index.php");
    die();
}

if($_SESSION['tipo'] != "S") {
    header("location:../index.php");
    die();
}
$_SESSION['_token'] =(!isset($_SESSION['_token']))? hash('sha512',rand(100,1000)):$_SESSION['_token'];
?>