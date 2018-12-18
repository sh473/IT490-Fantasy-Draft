#!/bin/bash
cd /var/www/html ; tar -cf - . | ssh shahin@10.0.2.9 "cd /var/www/html ; tar xvf -"