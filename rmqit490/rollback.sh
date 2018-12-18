#!/bin/bash
cd /var/www/html ; tar -cf - . | ssh shahin@10.0.2.8 "cd /var/www/html ; tar xvf -"