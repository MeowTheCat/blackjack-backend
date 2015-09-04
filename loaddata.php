<?php

date_default_timezone_set('America/Los_Angeles');


$mysqli = new mysqli("deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com", "root", "Linshuizhaohua!", "blackjack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$query = " truncate table raw;

LOAD DATA local INFILE '/users/miaomiao/downloads/3184_3257324_25993852_cmp.txt'
    INTO TABLE raw
  COLUMNS TERMINATED BY '|'       
   LINES  TERMINATED BY '\n' 
   IGNORE 1 LINES
;

LOAD DATA local INFILE '/users/miaomiao/downloads/3184_3257324_25993849_cmp.txt'
    INTO TABLE raw
  COLUMNS TERMINATED BY '|'       
   LINES  TERMINATED BY '\n' 
   IGNORE 1 LINES
;

delete from raw where primary_category = 'women' and attribute_2 not in ('dress','jacket','coat', 'top','skirt','suit','sweater');

delete from raw where primary_category = 'shoes' and secondary_category = 'men';


delete from raw where availability !='in-stock' or sale_price <=0 or sale_price is null;

delete from raw where sale_price/retail_price > 0.7;

delete from raw where sale_price/retail_price > 0.55 and primary_category = 'shoes';
delete from raw where sale_price/retail_price > 0.6 and attribute_2 in ('dress', 'skirt','suit');
delete from raw where sale_price/retail_price > 0.4 and attribute_2 = 'top';



";

    
$queries = explode(";", $query);
    
for($i=0;$i<(sizeof($queries)-1);$i++)
{
	$mysqli->query($queries[$i]);
	echo $mysqli->error;
	printf("-----------------\n");
}  

?>