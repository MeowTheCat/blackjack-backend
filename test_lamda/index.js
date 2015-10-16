
exports.handler = function(event, context) {
 
 
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com',
  user     : 'root',
  password : 'Linshuizhaohua!',
  database : 'blackjack'
});

//console.log(event.url);
connection.connect(function(err) {
  if (err) {
    context.fail (err);
  }
  //console.log('connected as id ' + connection.threadId);
});


var where ;

var query = 'select CEILING(retail_price) retail_price, CEILING(sale_price) sale_price,s3_url,product_url,brand,attribute_2 from clothing  order by rand() limit 8' ;

console.log(query);
var result;
connection.query(query, function(err, rows, fields) {
  if (err)  { context.fail (err); }
  else
  { result = 
    { "results":
    [
      {"image": rows[0].s3_url, "retail_price": rows[0].retail_price, "sale_price": rows[0].sale_price, "brand": rows[0].brand, "category": rows[0].attribute_2, "url": rows[0].product_url},
      {"image": rows[1].s3_url, "retail_price": rows[1].retail_price, "sale_price": rows[1].sale_price, "brand": rows[1].brand, "category": rows[1].attribute_2, "url": rows[1].product_url},
      {"image": rows[2].s3_url, "retail_price": rows[2].retail_price, "sale_price": rows[2].sale_price, "brand": rows[2].brand, "category": rows[2].attribute_2, "url": rows[2].product_url},
      {"image": rows[3].s3_url, "retail_price": rows[3].retail_price, "sale_price": rows[3].sale_price, "brand": rows[3].brand, "category": rows[3].attribute_2, "url": rows[3].product_url},
      {"image": rows[4].s3_url, "retail_price": rows[4].retail_price, "sale_price": rows[4].sale_price, "brand": rows[4].brand, "category": rows[4].attribute_2, "url": rows[4].product_url},
      {"image": rows[5].s3_url, "retail_price": rows[5].retail_price, "sale_price": rows[5].sale_price, "brand": rows[5].brand, "category": rows[5].attribute_2, "url": rows[5].product_url}, 
      {"image": rows[6].s3_url, "retail_price": rows[6].retail_price, "sale_price": rows[6].sale_price, "brand": rows[6].brand, "category": rows[6].attribute_2, "url": rows[6].product_url},
      {"image": rows[7].s3_url, "retail_price": rows[7].retail_price, "sale_price": rows[7].sale_price, "brand": rows[7].brand, "category": rows[7].attribute_2, "url": rows[7].product_url}
    ]};

    context.succeed(result);  
  }
});


connection.end(function(err) { console.log("ending error")});


}


