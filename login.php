<?php
	session_start();	
	if(isset($_SESSION['name'])){
	echo $_SESSION['name'];
	unset($_SESSION['name']);	
	}
	if(isset($_POST['submit'])){
	$user = array('test@gmail.com' => '123456');

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

	if (isset($user[$email]) && $user[$email] == $pwd){
	$_SESSION['userdata']['email'] = $user[$email];
	$_SESSION['username'] = $_POST['email'];
	header("location:index.php");
	exit;
	}else {
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Login Failed!</strong> Invalid Username and Password.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <title>Pick Box</title>
  </head>
  <body>
  <p><br></br></p>
<div class="container">
  <h2>Login Form</h2>
  <form method="post" action="">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
  </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
  
</html>
