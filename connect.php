<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'onebyone';
$port = NULL;
$socket = NULL;

$connect = mysqli_connect($hostname, $username, $password, $database);

if(!$connect){
    die("cant connect lil bro : " . mysqli_connect_error());
}else{
    mysqli_set_charset($connect, 'utf8');
}

?>