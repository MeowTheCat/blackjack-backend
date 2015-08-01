
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

connection.query('select image_url from raw order by rand() limit 1 ', function(err, rows, fields) {
  if (err) context.fail (err);
  console.log('image ', rows[0].image_url);
  context.succeed(rows[0].image_url);  
});

connection.end();


//context.succeed("2");  

}
