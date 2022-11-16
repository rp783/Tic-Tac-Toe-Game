var amqp = require('amqplib/callback_api')
module.exports = (callback) => {
  amqp.connect('amqp://admin:admin@192.168.1.111',
    (error, conection) => {
    if (error) {
      throw new Error(error);
    }

    callback(conection);
  })
}