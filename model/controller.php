<?php
    function matnoExist($matno, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM students WHERE matno = ?");
        $stmt->bind_param("s", $matno);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    function emailExist($email, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    function otpExist($email,$otpcode, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND otp = ?");
        $stmt->bind_param("si", $email,$otpcode);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    function passwordMatch($email, $password, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $fetch = $result->fetch_assoc();

            if(password_verify($password, $fetch['password'])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }