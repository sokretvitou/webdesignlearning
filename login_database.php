<?php
	include 'database.php';
	session_start();	
	// Retrieve the error message from index and display
	if(isset($_SESSION['loginreq'])){
	echo $_SESSION['loginreq'];
	unset($_SESSION['loginreq']);	
	}
	// Check if the submit button is submitted
	if(isset($_POST['submit'])){
		// Declared variable from the form input
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
		
		// Check if the input form is empty
		if(empty($username) || empty($pwd)){
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Login Failed!</strong> Input Username and Password.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}// Comapre the username and password from the database // Extra: Password needs hashing?
		else{
			$stmt = $db->prepare("SELECT * FROM `users` WHERE `UserName`= '$username' AND `PassWord`= '$pwd'");
			$stmt->execute();
			$result = $stmt->fetch();
			if($result == true){
				$_SESSION['UserID'] = $result['UserID'];
				$_SESSION['loggedin'] = true;
				$_SESSION['uname'] = $_POST['username'];
				header("location:index.php");
				exit;
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Login Failed!</strong> Invalid Username and Password.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
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
		<!-- Login Form -->
		<h2>Login Form</h2>
		  <form method="post" action="">
			<!-- Username box -->
			<div class="form-group">
			  <label for="username">Username:</label>
			  <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
			</div>
			<!-- Password box -->
			<div class="form-group">
			  <label for="pwd">Password:</label>
			  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
			</div>
			<!-- Remember Me --> <!-- Use Cookie to store user?? -->
			<div class="checkbox">
			  <label><input type="checkbox" name="remember"> Remember me</label>
			</div>
			<!-- Submit and Login -->
			<button type="submit" class="btn btn-default" name="submit">Sign in</button>
		  </form>
	</div>
    
  </body>
  
</html>
