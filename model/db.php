<?php
    //server variable
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'community';

    //create connection
    $mysqli = new mysqli($host, $user, $pass, $db);

    //check connection
    if($mysqli->connect_error){
        die("Cannot connect to server ".$mysqli->connect_error);
    }
