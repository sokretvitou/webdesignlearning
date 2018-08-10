<?php   
		include 'uploadfile.php';
		// Error message
		$msg = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Please sign in or register to access this page!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			// Check if the user is logged in otherwise require them to log in with SESSION!			
		    /*session_start();
			if(!isset($_SESSION['userdata']['email'])){
			$_SESSION['loginreq'] = $msg;
			header("location:login_database.php");
			exit;*/
			// Check if the user is logged in otherwise require them to log in
			if(!isset($_SESSION['loggedin'])){
			$_SESSION['loginreq'] = $msg;
			header("location:login_database.php");
			exit;
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
	
	<!-- Style CSS -->
	<link rel="stylesheet" href="stylo.css" type="text/css">
	
    <title>Pick Box</title>
  </head>
  <body>
  <!-- Navigation bar-->
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
						<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
							<ul class="navbar-nav mr-auto">
								<!-- Navbar link, nothing to add-->
								<li class="nav-item active">
									<a class="nav-link" href="home.php">Browse</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Link</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Link</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Link</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Link</a>
								</li>
							</ul>
						</div>
						<div class="mx-auto order-0">
						
							<!-- Logo or Name -->
							<a class="navbar-brand mx-auto" href="home.php">Pick Box</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						
						<!-- Navbar Dropdown -->
						<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
							<ul class="navbar-nav ml-auto">
									<li class="nav-item">
										<a class="nav-link" href="index.php">My Box</a>
									</li>
								  <li class="nav-item dropdown">
										<!-- Username on Navbar dropdown -->	
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  <?php echo $_SESSION['uname'] ?>
										</a>
										<!-- Dropdown link -->
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
										  <a class="dropdown-item" href="#">Holla</a>
										  <a class="dropdown-item" href="#">Settings</a>
										  <div class="dropdown-divider"></div>
										  <a class="dropdown-item" href="logout.php">Signout</a>
										</div>
								  </li>
							</ul>
						</div>
					</nav>
  <!-- End of Navbar -->
	
	<p><br></br></p>
    <div class="container">
	<!-- Upload file form -->
	<form action="index.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="image">Image</label><br>
			<input type="file" id="image" name="image">
		</div>
			<!-- Submit Button -->	
			<button type="submit" class="btn btn-danger" name= "submit">Upload</button>
	</form>
	
	<div class="row">
		<?php
		// Delete file function
			if(isset($_GET['delete'])){
				$photo = $_GET['delete'];
				$id = $_GET['id'];
				$delete = unlink("image/".$photo);
				$stmt = $db->prepare("DELETE FROM `image` WHERE id='$id'");
				if($delete){
					if($stmt->execute()){
						?>
								<!-- Need some work here -->
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong>Success!</strong> The image has been deleted.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<script>location.href='index.php'</script>
						<?php
					}else{
						?>
								<!-- Need some work here -->
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong>Error!</strong> The image has not been deleted from the database.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<script>location.href='index.php'</script>
						<?php
					}
				}else{
						?>
							<!-- Need some work here -->
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Error!</strong> Image has not been deleted from the directory.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<script>location.href='index.php'</script>
						<?php
				}
			}
			
			// Display image in a row
			$stm = $db->prepare("SELECT * FROM `image`  WHERE `UserID` = '".$_SESSION['UserID']."'");
			$stm->execute();
			while($row = $stm->fetch()){
		?>
		
		<div class="card">
						<a href="image\\<?php echo $row['name']?>" target="_blank"><img style="height:150px;width:210px" src= "image\\<?php echo $row['name']?>" alt= "image/<?php echo $row['name']?>"></a>
					  <div class="card-body">
						<p class="card-title"><?php echo $row['name']?></p>
						<a href="download.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button">Download</a>
						<a href="?delete=<?php echo $row['name']?>&id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button">Delete</a>
						</div>
					</div>	
		<?php
			}		
		?>
	</div>
	</div>
	<!-- Add One time only to avoid conflict -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> 
  </body>
  
</html>