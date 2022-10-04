var express = require('express');
var app = express();
var amqp = require('amqp/callback_api');

const port = 3001;

amqp.connect('amqp://localhost', (error, connection) => {
    connection.createChannel((error, channel) => { 
        var queue = 'FirstQueue';

        channel.assertQueue(queue, {durable: false});
        console.log('Waiting for the Message in ${queue}');
        channel.consume(queue, (message) => { 
            console.log('Received ${message.content}');
        }, {noAck: true});
        
    });
});

app.listen(port, () => console.log('App is listening on port ${port}!'))

