<?php   
		include 'uploadfile.php';
		$msg = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Please sign in or register to access this page!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		    session_start();
			if(!isset($_SESSION['userdata']['email'])){
			$_SESSION['name'] = $msg;
			header("location:login.php");
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
	<link rel="stylesheet" href="style.css" type="text/css">
	
    <title>Pick Box</title>
  </head>
  <body>
  <!-- Navigation bar-->
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
							<ul class="navbar-nav ml-auto">
								  <li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  <?php echo $_SESSION['username'] ?>
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
	<form action="index.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="image">Image</label><br>
			<input type="file" id="image" name="image">
		</div>
			<button type="submit" class="btn btn-default" name= "submit">Upload</button>
	</form>
	<div class="row">
		<?php
			if(isset($_GET['delete'])){
				$photo = $_GET['delete'];
				$id = $_GET['id'];
				$delete = unlink('image/'.$photo);
				$stmt = $db->prepare("DELETE FROM `image` WHERE id='$id'");
				if($delete){
					if($stmt->execute()){
						?>
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
			$stm = $db->prepare("SELECT * FROM image");
			$stm->execute();
			while($row = $stm->fetch()){
		?>
		<div class="col-sm-6 col-md-4">
				<div class="polaroid">
					<img style="height:200px;width:260px" src= "image\\<?php echo $row['photo']?>" alt= "image/<?php echo $row['photo']?>"> 
					<div class="polaroid-bottom">
					<a href="?delete=<?php echo $row['photo']?>&id=<?php echo $row['id']?>" class="btn btn-danger" role="button">Delete</a>
					</div>
				</div>
		</div>
		<?php
			}		
		?>
	</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script> 
	<script>
	$(document).ready(function(){
		$("#include").load("header.html");
	});
	</script>
  </body>
  
</html>