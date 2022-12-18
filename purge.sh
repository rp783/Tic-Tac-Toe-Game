###Login Queue###
sudo rabbitmqctl purge_queue loginQueue
sudo rabbitmqctl purge_queue loginDBQueue
sudo rabbitmqctl purge_queue loginQueue_response
###Register Queue###
sudo rabbitmqctl purge_queue registerQueue
sudo rabbitmqctl purge_queue registerDBQueue
sudo rabbitmqctl purge_queue registerQueue_response
###Game Queue###
sudo rabbitmqctl purge_queue LocalQueue
sudo rabbitmqctl purge_queue LocalDBQueue
sudo rabbitmqctl purge_queue LocalQueue_response
###Profile Queue###
sudo rabbitmqctl purge_queue profileQueue
sudo rabbitmqctl purge_queue profileDBQueue
sudo rabbitmqctl purge_queue profileQueue_response
