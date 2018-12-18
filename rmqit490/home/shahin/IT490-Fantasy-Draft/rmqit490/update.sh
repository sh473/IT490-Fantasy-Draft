#!/bin/bash
tar -czvf update.tar.gz ~/IT490-Fantasy-Draft/rmqit490/*.*
sudo scp shahin@localhost:~/IT490-Fantasy-Draft/rmqit490/update.tar.gz shahin@10.0.2.8:/var/www/html
tar -xzvf update.tar.gz -C shahin@10.0.2.8:/var/www/html
