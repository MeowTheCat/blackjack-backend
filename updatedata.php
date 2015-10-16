<?php

date_default_timezone_set('America/Los_Angeles');


$mysqli = new mysqli("deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com", "root", "Linshuizhaohua!", "blackjack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$query = " drop table if exists clothing_tmp;

create table clothing_tmp like clothing;

replace into clothing_tmp (product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,attribute_3,short_description,primary_category)
select product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,attribute_3,short_description,primary_category from raw group by sku_number;



update clothing_tmp a join image b on a.sku_number = b.sku_number set a.s3_url = b.s3_url;

delete from clothing_tmp where s3_url is null;

drop table clothing;

Rename Table clothing_tmp TO clothing; ";

$queries = explode(";", $query);
    
for($i=0;$i<(sizeof($queries)-1);$i++)
{
	$mysqli->query($queries[$i]);
	echo $mysqli->error;
	printf("-----------------\n");
}  

?>