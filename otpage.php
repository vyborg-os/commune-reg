<?php 
   // require_once 'model/db.php';
    //require_once './includes/function.php';
    require_once 'model/session.php';
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
        <h2 class="login-title">Complete your Registration</h2>
        <center><p style="color: blue;">Check your mail inbox/spam page for your otp!</p></center>
        <h6 class="text-center" id="msg" style="color: red;"></h6>
        <form class="login-form" id="otpform" method="POST">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <label for="otp">OTP for <?php echo $_SESSION['email']; ?></label>
                <input id="email" type="hidden" value="<?php echo $_SESSION['email']; ?>" name="mail"  />
                <input id="otp" type="number" placeholder="Enter OTP" name="otpcode" required />
            </div>
            <div class="col-lg-12 mt-3">
            <input type="hidden" name="enterotp">
            <center><button class="btn btn--form" type="submit" style="background-color: #3717ba;
    color: #fdf2e9; outline: none;">Submit <i class="loader fa fa-spinner fa-spin" style="color: white; display: none;"></i></button>
                </center>
                <a href="./"><i class="fa fa-arrow-left"></i>Back</a>
        </div>
        </div>
        </form>
    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#otpform').submit(function(e){
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
                    if(data==='Verification Successful'){
                        window.location.href = "login";
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