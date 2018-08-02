<?php
	// Modal Box testing not completed
	include 'database.php';
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	
	<link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </body>
 </head>
  <body>
<div class="container">
	<div class="row">
	<?php 
	$stm = $db->prepare("SELECT * FROM image");
			$stm->execute();
			while($row = $stm->fetch()){
	?>
	  <div class="col-sm-6 col-md-4">
					<div class="polaroid">
						<img style="height:200px;width:260px" src= "image\\<?php echo $row['name']?>"  alt= "image/<?php echo $row['name']?>" data-toggle="modal" data-target="#img<?php echo $row['id']?>"> <!-- bootstrap 4 required some text with the php variable to work -->
						<div class="polaroid-bottom">
						<a href="download.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button">Download</a>
						</div>
					</div>
					
			
			<!-- Modal Box -->
			<div class="modal fade" id="img<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
				   <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
				   </div>
				  <div class = "modal-body">
				  	<img style="height:auto;width:auto" src= "image\\<?php echo $row['name']?>"  alt= "image/<?php echo $row['name']?>">
				  </div>
			     </div>
			   </div>
			 </div>
			
	   </div>
		<?php
				}		
		?>
	 </div>
   </div>    
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
  </body>
</html>
