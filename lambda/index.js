
exports.handler = function(event, context) {
 
 
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com',
  user     : 'root',
  password : 'Linshuizhaohua!',
  database : 'blackjack'
});

console.log(event.url);
connection.connect(function(err) {
  if (err) {
    context.fail (err);
  }
  console.log('connected as id ' + connection.threadId);
});

var result;
connection.query('select CEILING(retail_price) retail_price, CEILING(sale_price) sale_price,s3_url,product_url,brand,attribute_2 from final order by rand() limit 1 ', function(err, rows, fields) {
  if (err)  { context.fail (err); }
  else
  { result = {"image": rows[0].s3_url, "retail_price": rows[0].retail_price, "sale_price": rows[0].sale_price, "brand": rows[0].brand, "category": rows[0].attribute_2, "url": rows[0].product_url};
    context.succeed(result);  
  }
});


  connection.end();


}
