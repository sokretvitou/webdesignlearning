<?php 
	include 'database.php';
?>

<?php
	include 'download.php';
	session_start();
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<!-- Style CC -->
	<link rel="stylesheet" type="text/css" href="stylo.css">
    <title>Homepage</title>
  </head>
  <body>
	<!-- Navbar -->
  	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
						<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
							<ul class="navbar-nav mr-auto">
								<li class="nav-item">
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
							</ul>
						</div>
						<div class="mx-auto order-0">
							<a class="navbar-brand mx-auto" href="home.php">Pick Box</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						
						<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
							<ul class="navbar-nav ml-auto">
							<?php if(isset($_SESSION["loggedin"]))	{
								?>
								<a id="btnsignin" class = "btn btn-primary" href="login_database.php" style="visibility:hidden">Sign in</a>';
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
								<?php 
								}else{
								?>
								<a id="btnsignin" class = "btn btn-primary" href="login_database.php">Sign in</a>';
								<?php }
								?>
							</ul>
						</div>
					</nav>
	<!-- End of Navbar -->
	
	<!-- Display image in a row -->
  <p><br></br></p>
  <div class="container">
	<div class="row">
	<?php 
	$stm = $db->prepare("SELECT * FROM image");
			$stm->execute();
			while($row = $stm->fetch()){
	?>
	
					<div class="card">
						<a href="image\\<?php echo $row['name']?>" target="_blank"><img style="height:150px;width:210px" src= "image\\<?php echo $row['name']?>" alt= "image/<?php echo $row['name']?>"></a>
					  <div class="card-body">
						<p class="card-title"><?php echo $row['name']?></p>
						<a href="download.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button">Download</a>
						</div>
					</div>		
		<?php
				}		
		?>
	 </div>
   </div>
	<!-- Preview document extension file -->
	<?php 
	
	?>
   
   
   <!-- Add One time only to avoid conflict -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> 
 </body>
</html>