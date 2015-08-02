
exports.handler = function(event, context) {
 
 
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'deal.cpg8bvjgkezo.us-east-1.rds.amazonaws.com',
  user     : 'root',
  password : 'Linshuizhaohua!',
  database : 'blackjack'
});

console.log('prepare' );

connection.connect(function(err) {
  if (err) {
    context.fail (err);
  }
  console.log('connected as id ' + connection.threadId);
});

connection.query('select CEILING(retail_price) retail_price, CEILING(sale_price) sale_price,image_url from raw where sale_price>0 and sale_price/retail_price < 0.7 order by rand() limit 1 ', function(err, rows, fields) {
  if (err)  { context.fail (err); }
  var result = {"image": rows[0].image_url, "retail_price": rows[0].retail_price, "sale_price": rows[0].sale_price};
  context.succeed(result);  
});

connection.end();



}
