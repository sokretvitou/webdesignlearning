<?php
	include 'database.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		try{
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT * FROM `image` WHERE id ='$id'");
		$stmt->execute();
		$data = $stmt->fetch(); 
		
		$file = "image/".$data['name'];
		  if(file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
			}		
		}catch(PDOException $e){
				echo "Connection failed".$e->getMessage();	
		}
		
	}
?>