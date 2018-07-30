<?php 
	include 'database.php';
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
	<link rel="stylesheet" href="style.css" type="text/css">
    <title>Homepage</title>
  </head>
  <body>
  <!-- Navbar -->
  	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
						<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
							<ul class="navbar-nav mr-auto">
								<li class="nav-item active">
									<a class="nav-link" href="index.php">Home</a>
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
							<a class="navbar-brand mx-auto" href="#">Navbar 2</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
							<form class="form-inline ml-auto">
								 <a class = "btn btn-primary" href="login.php">Sign in</a>
							</ul>
						</div>
					</nav>
	<!-- End of Navbar -->

  </div>
  <p><br></br></p>
  <div class="container">
	<div class="row">
	<?php 
	$stm = $db->prepare("SELECT * FROM image");
			$stm->execute();
			while($row = $stm->fetch()){
	?>
	  <div class="col-sm-6 col-md-4">
					<div class="polaroid2">
						<img style="height:200px;width:260px" src= "image\\<?php echo $row['photo']?>" alt= "image/<?php echo $row['photo']?>"> 
					</div>
	   </div>
		<?php
				}		
		?>
	 </div>
   </div>
 </body>
</html>