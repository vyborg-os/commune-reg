<?php
require_once 'db.php';
    session_start();
    function loggedIn(){
        if(isset($_SESSION['username'])){
            return true;
        }else{
            return false;
        }
    }

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];

        $stmt = $mysqli->prepare("SELECT * FROM lecturer WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
    }
    