<?php
		session_start();
		include 'database.php';
		// Check if the form contains any file
		if(isset($_FILES["image"])){
			// Get file values
			$name = $_FILES["image"]["name"];
			$tmp = $_FILES["image"]["tmp_name"];
			$size = $_FILES["image"]["size"];
			$type = $_FILES["image"]["type"];
			
			// Seperate the file name from its extension
			$fileExt = explode('.',$name);
			// Convert uppercase letter to lowercase
			$fileActualExt = strtolower(end($fileExt));
			

			$allowed = array('jpg','png','jpeg','txt','docx','pdf','xlsx','ppt','zip','mp4','mp3');
			// Check if file extension is included in the allowed extension
			if(in_array($fileActualExt,$allowed)){
				// Check size
				if($size < 1000000){
				$destination = "image/".basename($name);
				// Check if the file already exists
				if(!file_exists($destination)){
					// Move file to directory
					if(move_uploaded_file($tmp,$destination)){
						try {
							$stm = $db->prepare("INSERT INTO `image`(`name`, `size`, `type`, `UserID`) VALUES ('$name','$size','$fileActualExt',(select `UserID` from users where `UserID` ='".$_SESSION['UserID']."'))");
							$stm->execute();
						}catch(PDOException $e){
							echo "Connection failed".$e->getMessage();	
						}
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Success!</strong>Image has been uploaded!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Errored!</strong> There was an error uploading your file!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}	
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Failed!</strong> Image already exists!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
					}	
				}else{
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Failed!</strong> File size is too big!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
				}	
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Failed!</strong> You cannot upload this file type!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}	
		}		
?>