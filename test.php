<?php
	copy('http://www.forever21.com/images/default_750/00172357-03.jpg', 'file.jpg');
	
	$ini_filename = 'file.JPG';
$im = imagecreatefromjpeg($ini_filename );

$ini_x_size = getimagesize($ini_filename )[0];
$ini_y_size = getimagesize($ini_filename )[1];

//the minimum of xlength and ylength to crop.
$crop_measure = min($ini_x_size, $ini_y_size);

// Set the content type header - in this case image/jpeg
//header('Content-Type: image/jpeg');

$to_crop_array = array('x' =>0 , 'y' => 0, 'width' => $crop_measure, 'height'=> $crop_measure);
$thumb_im = imagecrop($im, $to_crop_array);

imagejpeg($thumb_im, 'thumb.jpeg', 100);





	
?>

