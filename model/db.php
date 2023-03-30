<?php
    //server variable
    $host = 'localhost';
    $user = 'greziti2_vhk';
    $pass = 'Programmer$$01';
    $db = 'greziti2_community';

    //create connection
    $mysqli = new mysqli($host, $user, $pass, $db);

    //check connection
    if($mysqli->connect_error){
        die("Cannot connect to server ".$mysqli->connect_error);
    }