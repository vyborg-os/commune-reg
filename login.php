<?php 
   // require_once 'model/db.php';
    //require_once './includes/function.php';
    //require_once 'model/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commune</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="background: linear-gradient(to right bottom, #647DEE, #7F53AC); background-repeat: repeat-y;">
    <div class="col-lg-6 container">
        <div class="row">
             <div class="col-lg-12">
            </center><img src="img/logo.jpeg" width="100%"/>
            <center>
            </div>
        </div>
        <h2 class="login-title">Welcome, Login to your Account</h2>
        <h6 class="text-center" id="msg" style="color: red;"></h6>
        <form class="login-form" id="loginform" method="POST">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <label for="email">Email </label>
                <input id="email" type="email" placeholder="Enter Email" name="email" required />
            </div>
            
            <div class="col-lg-12 mt-3">
                <label for="password">Password </label>
                <input id="password" type="password" placeholder="password" name="password" required/>
            </div>
            <div class="col-lg-12 mt-3">
                <label for="captcha"> <?php 
                $a = rand(1, 10);
                $b = rand(1, 10);
                echo 'Solve Math Captcha: <b style="color: red;">'.$a.' + '.$b.' = </b>';
                ?> </label>
                <input type="hidden" name="calc" value="<?php echo $a + $b; ?>">
                <input id="captcha" type="number" placeholder="Your Answer" name="cap" required/>
            </div>
            
            <div class="col-lg-12 mt-3">
            <input type="hidden" name="login">
            <center><button class="btn btn--form" type="submit" style="background-color: #3717ba;
    color: #fdf2e9; outline: none;">Login <i class="loader fa fa-spinner fa-spin" style="color: white; display: none;"></i></button>
                </center>
        </div>
        </div>
        </form>
    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#loginform').submit(function(e){
  			e.preventDefault()
            $(".loader").show();
            setTimeout(function(){
                $(".loader").hide();
            }, 2000);
  			var datas = new FormData(this);
  			$.ajax({
  				url: 'model/auth.php',
  				method: 'POST',
  				data: datas,
  				success: function(data){
  					 if(data==='Login Successful'){
                        window.location.href = "community";
                    }else{
                        $('#msg').html(data);
                    }
  				},
  				cache: false,
  				contentType: false,
  				processData: false
  			})
  		})
  	})
    </script>
</body>
</html>