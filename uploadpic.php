<?php
require 'aws.phar';
include_once('easyphpthumbnail.class.php');
date_default_timezone_set('America/Los_Angeles');
//copy('http://www.forever21.com/images/default_750/00172357-03.jpg', 'file.jpg');
$old_file = 'file.jpg';

$thumb = new easyphpthumbnail;

$xSize = getimagesize($old_file)[0];
$ySize = getimagesize($old_file)[1];

echo $xSize; echo $ySize;

$crop_left = 0;
$crop_right = 0;
$crop_top = 0;
$crop_bottom = 0;


if($ySize/$xSize > 3.5/2.5) { $crop_top = ($ySize - $xSize*3.5/2.5)/2; $crop_bottom = ($ySize - $xSize*3.5/2.5)/2;}
if($ySize/$xSize < 3.5/2.5) { $crop_left = ($xSize - $ySize*2.5/3.5)/2; $crop_right =($xSize - $ySize*2.5/3.5)/2;}

$thumb -> Cropimage = array(1,1,$crop_left,$crop_right,$crop_top,$crop_bottom);
//$thumb -> Backgroundcolor = '#123456';
//$thumb -> Clipcorner = array(2,5,0,1,1,1,1);
//$thumb -> Maketransparent = array(1,0,'#123456',0);

$thumb -> Borderpng = 'frame_red.png';
$thumb -> Thumbsize = 100;
$thumb -> Percentage = true;
$thumb -> Thumbfilename = 'newfile.jpg';
//$thumb -> Thumbsaveas ="png";  
$thumb -> Createthumb($old_file,'file');

use Aws\S3\S3Client;
$s3 = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'credentials' => [
        'key'    => 'AKIAJOWOE3ZEKD3DFUNQ',
        'secret' => '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',
    ],
]);

$bucket = 'lumiaomiao-macy';

// $filepath should be absolute path to a file on disk						
$filename = 'newfile.jpg';
					
// Upload a file.
$result = $s3->putObject(array(
    'Bucket'       => $bucket,
    'Key'          => $filename,
    'SourceFile'   => $filename,
    'ContentType'  => 'image/jpeg',
    'StorageClass' => 'STANDARD'
 
));


?>