<?php 
session_start();
function d($var){
    echo '<pre style="padding: 20px; border: 1px solid red; color: green; background-color: black;">';
    var_dump($var);
    echo '</pre>';
    exit();
}
include 'model.php';
include 'controller.php';
include 'view.php';
