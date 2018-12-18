#!/bin/bash
tar -czvf rollback.tar.gz /var/www/html/*.*
sudo scp shahin@localhost:~/IT490-Fantasy-Draft/rmqit490/rollback.tar.gz shahin@10.0.2.8:/var/www/html
tar -xzvf rollback.tar.gz -C shahin@10.0.2.8:/var/www/html
