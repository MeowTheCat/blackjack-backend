truncate table raw;

LOAD DATA local INFILE '/users/miaomiao/downloads/3184_3257324_25993852_cmp.txt'
    INTO TABLE raw
  COLUMNS TERMINATED BY '|'       
   LINES  TERMINATED BY '\n' 
   IGNORE 1 LINES
;

delete from raw where availability !='in-stock' or sale_price <=0 or sale_price is null or sale_price/retail_price >0.7 or attribute_2 not in ('dress','jacket','coat', 'top','skirt','suit','sweater');

insert ignore into image(sku_number) select distinct sku_number from raw;	