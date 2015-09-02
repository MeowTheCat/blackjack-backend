<?php

date_default_timezone_set('America/Los_Angeles');


$mysqli = new mysqli("deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com", "root", "Linshuizhaohua!", "blackjack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$query = " drop table if exists clothing_tmp;

create table clothing_tmp like clothing;

replace into clothing_tmp (product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,attribute_3,short_description,primary_category)
select product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,attribute_3,short_description,primary_category from raw;

update clothing_tmp  set xs = true where attribute_3 in ('XXS','XS','P/XS','P/XXS','0','2','4','32','0P','2P','4P','0W','2W','4W') ; 
update clothing_tmp  set s = true where attribute_3 in ('S','P/S','4','6','8','34','36','4P','6P','8P','4W','6W','8W') ; 
update clothing_tmp  set m = true where attribute_3 in ('M','P/M','8','10','12','38','40','8P','10P','12P','8W','10W','12W') ; 
update clothing_tmp  set l = true where attribute_3 in ('L','P/L','12','14','16','42','44','12P','14P','16P','12W','14W','16W') ; 
update clothing_tmp  set xl = true where attribute_3 in ('XXL','XL','P/XL','P/XXL','16','18','20','22','24','46','48','16P','18P','20P','22P','24P','16W','18W','20W','22W','24W') ; 

update clothing_tmp  set shoesize = cast(attribute_3 as decimal(3,1)) where primary_category = 'shoes';

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