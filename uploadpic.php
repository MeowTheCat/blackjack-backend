<?php

date_default_timezone_set('America/Los_Angeles');


$mysqli = new mysqli("deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com", "root", "Linshuizhaohua!", "blackjack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$res = $mysqli->query("replace into final (product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,s3_url)  ");



$query = '';
    
if(!$mysqli->query($query)) {echo "error :".$query; }

    
     



?>