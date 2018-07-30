<?php
		include 'database.php';
		if(isset($_FILES["image"])){
			$name = $_FILES["image"]["name"];
			$tmp = $_FILES["image"]["tmp_name"];
			$fullpath = "image\\".basename($_FILES["image"]["name"]);
			if(!file_exists($fullpath)){
			if(move_uploaded_file($_FILES["image"]["tmp_name"],$fullpath)){
			try {
				$stm = $db->prepare("INSERT INTO `image`( `photo`) VALUES ('$name')");
				$stm->execute();
			}catch(PDOException $e){
				echo "Connection failed".$e->getMessage();	
			}
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Success!</strong>Image has been uploaded.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Failed!</strong> Image has not been deleted.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}	
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Failed!</strong> Image already exists.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
		}			
?>