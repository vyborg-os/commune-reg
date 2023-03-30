<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'db.php';
require_once 'controller.php';
require_once 'session.php';
require 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['register'])){
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $phone = trim($_POST['phone']);
            $email = trim($_POST['email']);
            $sum = trim($_POST['calc']);
            $captcha = trim($_POST['cap']);
            $password = trim($_POST['password']);
            $cpassword = trim($_POST['cpassword']);
            $uppw = preg_match('@[A-Z]@', $password);
            $lwpw = preg_match('@[a-z]@', $password);
            $nmpw = preg_match('@[0-9]@', $password);
            $chpw = preg_match('@[^\w]@', $password);
            $otp = rand(5000,100000);
            if(empty($firstname) || empty($lastname) || empty($captcha)  || empty($email) || empty($password) || empty($cpassword) ){
                echo 'All fields are required';
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo'Invalid email entered';
            }else if(emailExist($email, $mysqli)){
                echo 'Email Already Exist';
            }
            else if($password!==$cpassword){
                echo 'Password Mismatch';
            }
            else if(!$uppw || !$lwpw || !$nmpw || !$chpw || strlen($password) < 9){
                echo 'Password not strong (must contain numbers, uppercase, special characters and more than 8)';
            }
            else if(!is_numeric($phone)){
                echo 'Phone Number must be numeric!';
            }
            else if(strlen($phone) < 11 || strlen($phone) > 15){
                echo 'Phone Number has abnormal length!';
            }
            else if(is_numeric($firstname) || is_numeric($lastname)){
                echo 'Firstname/Lastname cannot contain numbers';
            }
            else if($password!==$cpassword){
                echo 'Password Mismatch';
            }
            else if($captcha!==$sum){
                echo 'Incorrect Captcha Entered, try again!
                ';
            }else{
                $password = password_hash($password, PASSWORD_BCRYPT);
                
                $insert = $mysqli->prepare("INSERT INTO users(firstname, lastname, phone, email, password, otp) VALUES(?,?,?,?,?,?)");
                $insert->bind_param("ssssss", $firstname, $lastname, $phone, $email, $password, $otp);
                $insert->execute();

                if($insert->affected_rows > 0){
                    //echo 'registration successful';
                    $_SESSION['email'] = $email;
                    $to = $email;
                    $subject = 'OTP Authentication';
                    //$snd = mail($email,$subject,$otp);
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Host = 'yourmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'commune@yourmail.com';
                        $mail->Password = 'yourpassword';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                        $mail->setFrom('commune@yourmail.com', 'Commune');
                        $mail->addAddress($to);
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        // $mail->Body = "Hello World";
                        ob_start();
                        $body = $otp;
                        ob_end_clean();
                        $mail->msgHTML($body);
                             if($mail->send()==true){
                                echo 'Registration Successful';
                                //header("location: ../otpage?mail=$email");
                            }else{
                                echo 'Cannot send otp, try again';
                            }
                    
                   
                }else{
                    $err = $insert->error;
                }
            }
        }
        if(isset($_POST['enterotp'])){
            $otpcode = trim($_POST['otpcode']);
            $email = trim($_POST['mail']);
            if(empty($otpcode)){
                echo 'All fields are required';
            }else if(!otpExist($email,$otpcode, $mysqli)){
                echo 'Invalid OTP, check and retry';
            }else{
               echo 'Verification Successful';
            }
        }
          if(isset($_POST['login'])){
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $sum = trim($_POST['calc']);
            $captcha = trim($_POST['cap']);
            if(empty($email) || empty($password)){
                echo 'All fields are required';
            }else if(!emailExist($email, $mysqli)){
                echo 'Account does not exist';
            }else if($captcha!==$sum){
                echo 'Incorrect Captcha Entered, try again!
                ';
            }else{
                if(passwordMatch($email, $password, $mysqli)){
                    echo 'Login Successful';
                    $_SESSION['email'] = $email;
                }else{
                    echo 'Invalid username and/or password entered';
                }
            }
        }
    }
