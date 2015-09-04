
exports.handler = function(event, context) {
var AWS = require('aws-sdk'); 
AWS.config.update({accessKeyId: 'AKIAJOWOE3ZEKD3DFUNQ', secretAccessKey: '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'});
AWS.config.update({region: 'us-east-1'});
AWS.config.apiVersions = {
  ses: '2010-12-01',
  // other service API versions
};
var ses = new AWS.SES();

var params = {
  Destination: { /* required */
    
    ToAddresses: [
      event.email,
      /* more items */
    ],
    BccAddresses: [ 'windbell9@hotmail.com' ] 
  },
  Message: { /* required */
    Body: { /* required */
      Html: {
        Data: 'Price: $' + event.price +'<br/>'
        +'Availability and price fluctuate constantly. Check it before it is gone.<br/>'
        +'<a href="' + event.url + '" target="_blank">' + '<img src="http://s3.amazonaws.com/miaomimi-keep/view.png" width="104" height="30" alt="View">' + '</a>' + '<br/><br/>'
        +'<img src="' + event.image + '" alt="Product Image" style="width:250px;height:350px;">',  
      }
    },
    Subject: { /* required */
      Data: 'The ' + event.brand + ' ' + event.category +' you love. '
      //Charset: 'UTF－8'
    }
  },
  Source: 'Fashion Casino<fashioncollect@alicewonderland.net>', /* required */
  ReplyToAddresses: [
    'windbell9@gmail.com',
    /* more items */
  ],
  ReturnPath: 'windbell9@gmail.com'
 
};
if(typeof event.price === "undefined") context.fail ("is this a test?");
else
{
  ses.sendEmail(params, function(err, data) {
    var result;
    if (err) {console.log(err, err.stack); context.fail (err);} // an error occurred
    else     {console.log(data);   context.succeed("1"); }         // successful response
  });
}

   
}

