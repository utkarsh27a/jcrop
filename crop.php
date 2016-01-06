<?php 
	if (isset($_FILES['image']['name'])) {
		$result = new stdClass();
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;
		$filename = $_FILES['image']['name'];
		
		$src = $_FILES['image']['tmp_name'];
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);

		// header('Content-type: image/jpeg');
		if(imagejpeg($dst_r,'uploded/'.$filename,$jpeg_quality)) {
			$result->status = 1;
			$result->message = "Cropped";
			die(json_encode($result));
		}else {
			$result->status = 0;
			$result->message = "Error";
			die(json_encode($result));			
		}


		exit;
	}
?>