<?php

//define the base path of the image
define("BASE_PATH", "http://localhost/thumbnail/");

function thumb_helper( $src, $destination = NULL, $desired_width = 100, $desired_height = 100){

	// Prepend the BASH_PATH to make absolute path of the image
	$src = BASE_PATH . $src;

	//get image name form src
	$image_name = basename($src);

	//get image file type
	$image_type = pathinfo($image_name, PATHINFO_EXTENSION);
	
	//check image file type for create source image
	if($image_type == 'jpg' ? $source_image = imagecreatefromjpeg($src) : ($image_type == 'png' ? $source_image = imagecreatefrompng($src) : FALSE)){

		//get height and width of source image
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
		//create a virtual image
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

		//copy source image to virtual image
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

		//stores virtually created thumbnail image in destinatin
		imagejpeg($virtual_image, $destination.$image_name, 100);

	}
	else{
		//message when image file type is not valid
		echo "File Type Not Supported !";
	}
}

thumb_helper( "upload/cover.png" , "thumb/" , 200 , 200);
