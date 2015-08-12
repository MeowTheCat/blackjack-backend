<?php

date_default_timezone_set('America/Los_Angeles');


$mysqli = new mysqli("deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com", "root", "Linshuizhaohua!", "blackjack");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$query = ' drop table if exists final_tmp;

create table final_tmp like final;

replace into final_tmp (product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,attribute_3)
select product_id, sku_number, product_url,sale_price,retail_price, brand, attribute_2,attribute_3 from raw;

update final_tmp a join image b on a.sku_number = b.sku_number set a.s3_url = b.s3_url;

delete from final_tmp where s3_url is null;

drop table final;

Rename Table final_tmp TO final; ';


    
$result = $mysqli->multi_query($query);
echo $result;

     



?>