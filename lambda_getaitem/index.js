
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

var str = event.size;
var arr = str.split("*");

var where ;
if(arr.length == 1 || arr.length == 6)  where = ' where primary_category = "women" ';
else
{ 
  where = " where " + arr[1] + ' is true '; 
  for(var i=2; i<= arr.length-1; i++) where = where + ' or ' + arr[i] + ' is true ';
}

shoesize = parseFloat(event.shoesize) + 0.5;
where = where + ' or shoesize=' + event.shoesize + ' or shoesize=' + shoesize;

var query = 'select CEILING(retail_price) retail_price, CEILING(sale_price) sale_price,s3_url,product_url,brand,attribute_2 from clothing ' + where + ' order by rand() limit 1 ' ;

console.log(query);
var result;
connection.query(query, function(err, rows, fields) {
  if (err)  { context.fail (err); }
  else
  { result = {"image": rows[0].s3_url, "retail_price": rows[0].retail_price, "sale_price": rows[0].sale_price, "brand": rows[0].brand, "category": rows[0].attribute_2, "url": rows[0].product_url};
    context.succeed(result);  
  }
});


connection.end();


}


