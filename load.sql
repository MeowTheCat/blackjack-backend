LOAD DATA local INFILE '/users/miaomiao/downloads/3184_3257324_25993852_cmp.txt'
    INTO TABLE raw
  COLUMNS TERMINATED BY '｜'       
   LINES  TERMINATED BY '\n' 
;

