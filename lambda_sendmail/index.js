
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
    ]
  },
  Message: { /* required */
    Body: { /* required */
      Html: {
        Data: 'The ' + event.brand + ' ' + event.category +' From Crazy Sale. <br/>'
        +'Availability and price fluctuate constantly. Check it before it is gone.<br/>'
        +'<a href="' + event.url + '" target="_blank">' + '<img src="http://s3.amazonaws.com/miaomimi-keep/view.png" width="104" height="30" alt="View">' + '</a>' + '<br/><br/>'
        +'<img src="' + event.image + '" alt="Product Image" style="width:250px;height:350px;">',  
      }
    },
    Subject: { /* required */
      Data: 'The piece you love from Crazy Sale.'
      //Charset: 'UTF－8'
    }
  },
  Source: 'Crazy Sale<CrazySale@alicewonderland.net>', /* required */
  ReplyToAddresses: [
    'windbell9@gmail.com',
    /* more items */
  ],
  ReturnPath: 'windbell9@gmail.com'
 
};
ses.sendEmail(params, function(err, data) {
  var result;
  if (err) {console.log(err, err.stack); context.fail (err);} // an error occurred
  else     {console.log(data);   context.succeed("1"); }         // successful response
});


   
}

