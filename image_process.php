<?php
require 'aws.phar';
include_once('easyphpthumbnail.class.php');
date_default_timezone_set('America/Los_Angeles');


use Aws\S3\S3Client;
$s3 = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'credentials' => [
        'key'    => 'AKIAJOWOE3ZEKD3DFUNQ',
        'secret' => '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',
    ],
]);


$mysqli = new mysqli("deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com", "root", "Linshuizhaohua!", "blackjack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$res = $mysqli->query("select  a.image_url, a.sku_number from raw a join image b on a.sku_number=b.sku_number where b.s3_url is null group by a.sku_number; ");


$res->data_seek(0);
$n=0;

$old_file = 'file.jpg';

//Loppppppppppppp.....
while ($row = $res->fetch_assoc()) 
{ 
    $n++;
 
    echo "start getting image".$n."\n";

    copy(str_replace("wid=300","wid=600",$row['image_url']), $old_file );

    $thumb = new easyphpthumbnail;

    $xSize = getimagesize($old_file)[0];
    $ySize = getimagesize($old_file)[1];
   
    if($xSize<=0 | $ySize <=0) continue;
    echo $row['sku_number']."\n";

    $crop_left = 0;
    $crop_right = 0;
    $crop_top = 0;
    $crop_bottom = 0;

    if($ySize/$xSize > 3.5/2.5) { $crop_top = ($ySize - $xSize*3.5/2.5)/2; $crop_bottom = ($ySize - $xSize*3.5/2.5)/2;}
    if($ySize/$xSize < 3.5/2.5) { $crop_left = ($xSize - $ySize*2.5/3.5)/2; $crop_right =($xSize - $ySize*2.5/3.5)/2;}
    $thumb -> Cropimage = array(1,1,$crop_left,$crop_right,$crop_top,$crop_bottom);
 
    $thumb -> Borderpng = 'frame_red_left.png';
    $thumb -> Thumbsize = 100;
    $thumb -> Percentage = true;
    $thumb -> Thumbfilename = 'newfile.jpg';
    try { $thumb -> Createthumb($old_file,'file'); }
    catch (Exception $e) 
    {
       echo "unable to get image for sku: ";
       echo $row['sku_number']."\n";
       continue;
    }
    if (!file_exists('newfile.jpg')) continue;

    // Upload a file.
  try{
    $s3_result = $s3->putObject(array(
        'Bucket'       => 'lumiaomiao-macy',
        'Key'          => $row['sku_number'],
        'SourceFile'   => 'newfile.jpg',
        'ContentType'  => 'image/jpg',
        'StorageClass' => 'STANDARD'
     
    ));
    //echo $s3_result['ObjectURL'] . "\n";
   }
  catch (S3Exception $e) 
    {
        echo "unable to copy to s3 ";
        echo $e->getMessage() . "\n";
        continue;
    }

    unlink("newfile.jpg");


   $s3_url = "http://s3.amazonaws.com/lumiaomiao-macy/".$row['sku_number'];
  
 
    $query = 'update image set s3_url = "'. $s3_url. '" where sku_number = "'.$row['sku_number'].'" ;';
    
    if(!$mysqli->query($query)) {echo "error :".$query; }

} //loop..............


?>