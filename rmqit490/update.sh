#!/bin/bash
cd ~/IT490-Fantasy-Draft/rmqit490 ; tar -cf - . | ssh shahin@10.0.2.8 "cd /var/www/html ; tar xvf -"
