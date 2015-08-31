
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
      'windbell9@gmail.com',
      /* more items */
    ]
  },
  Message: { /* required */
    Body: { /* required */
      Html: {
        Data: event.url + '<img src="http://s3.amazonaws.com/miaomimi-macy/2078522" alt="Product Image" style="width:250px;height:350px;">',
       
      }
    },
    Subject: { /* required */
      Data: 'The Calvin Klein Dress From Crazy Sale', /* required */
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
  else     {console.log(data);  result = {"result": event.score}; context.succeed(result); }         // successful response
});




   
}

