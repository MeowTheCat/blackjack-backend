CREATE TABLE `image` (
  `sku_number` varchar(64) NOT NULL DEFAULT '',
  `s3_url` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`sku_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `raw` (
  `product_id` varchar(32) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `sku_number` varchar(64) DEFAULT NULL,
  `primary_category` varchar(50) DEFAULT NULL,
  `secondary_category` varchar(500) DEFAULT NULL,
  `product_url` varchar(2000) DEFAULT NULL,
  `image_url` varchar(2000) DEFAULT NULL,
  `buy_url` varchar(2000) DEFAULT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `long_description` varchar(2000) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `discount_type` varchar(10) DEFAULT NULL,
  `sale_price` float DEFAULT NULL,
  `retail_price` float DEFAULT NULL,
  `begin_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `manufacturer_part_no` varchar(50) DEFAULT NULL,
  `manufacturer_name` varchar(250) DEFAULT NULL,
  `shipping_info` varchar(50) DEFAULT NULL,
  `availability` varchar(50) DEFAULT NULL,
  `upc` varchar(15) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `M1` varchar(2000) DEFAULT NULL,
  `pixel` varchar(128) DEFAULT NULL,
  `attribute_1` varchar(128) DEFAULT NULL,
  `attribute_2` varchar(128) DEFAULT NULL,
  `attribute_3` varchar(128) DEFAULT NULL,
  `attribute_4` varchar(128) DEFAULT NULL,
  `attribute_5` varchar(128) DEFAULT NULL,
  `attribute_6` varchar(128) DEFAULT NULL,
  `attribute_7` varchar(128) DEFAULT NULL,
  `attribute_8` varchar(128) DEFAULT NULL,
  `attribute_9` varchar(128) DEFAULT NULL,
  `attribute_10` varchar(128) DEFAULT NULL,
  `modification` char(1) DEFAULT NULL,
  KEY `sku_number` (`sku_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `clothing` (
  `product_id` varchar(32) NOT NULL DEFAULT '',
  `sku_number` varchar(64) DEFAULT NULL,
  `product_url` varchar(2000) DEFAULT NULL,
  `s3_url` varchar(2000) DEFAULT NULL,
  `sale_price` float DEFAULT NULL,
  `retail_price` float DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `attribute_2` varchar(128) DEFAULT NULL,
  `attribute_3` varchar(128) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `s` tinyint(1) DEFAULT '0',
  `m` tinyint(1) DEFAULT '0',
  `l` tinyint(1) DEFAULT '0',
  `xl` tinyint(1) DEFAULT '0',
  `xs` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `sku_number` (`sku_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


