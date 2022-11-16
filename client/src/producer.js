const amqp = require("amqplib");

async function consumeMessages(){
  const connection = await AMQPBaseClient.connect("ampq://admin:admin@192.168.1.111");
  const channel = await connection.createChannel();

  await channel.assertExchange("logExchange", "direct");

  const q = await channel.assertQueue("InfoQueue");

  await channel.blindQueue(q.queue, "logExchange", "Info");

  channel.consume(q.queue, (msg) => {
    const data = JSON.parse(msg.content);
    console.log(data);
    channel.acl(msg);
  });
}
comsumeMessages();