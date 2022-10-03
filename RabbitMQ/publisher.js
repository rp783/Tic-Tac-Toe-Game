var express = require('express');
var app = express();
var amqp = require('amqp/callback_api');

const port = 3001;

amqp.connect('amqp://localhost', (error, connection) => {
    connection.createChannel((error, channel) => { 
        var queue = 'Hello';
        var message = { type: '2', content: 'Hello WOrld' };

        channel.assertQueue(queue, {durable: false});
        channel.sendToQueue(queue, Buffer.from(JSON.stringify(message)));
        console.log('Message was successfully sent');
    });

    setTimeout(() => {
        connection.close();
        process.exit(0); }, 500);
    
app.listen(port, () => console.log('App listening on port ${port}!'))
    })
