

function sendmsg(exchange,queue,msg){

var amqp = require('amqplib/callback_api');

amqp.connect('amqp://admin:admin@172.26.16.166', function(error0, connection) {
    if (error0) {
        throw error0;
    }
    connection.createChannel(function(error1, channel) {
        if (error1) {
            throw error1;
        }
        channel.assertExchange(exchange,'direct',{
            durable:false
        });
        channel.assertQueue(queue, {
            durable: false
        });
        channel.sendToQueue(queue, Buffer.from(JSON.stringify(msg)));
    
    

        console.log(" [x] Sent %s", msg);
        setTimeout(function() {
            connection.close();
            process.exit(0);
        }, 500);
})});
    
};
module.exports = {sendmsg}