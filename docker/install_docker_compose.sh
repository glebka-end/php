#!/bin/bash

###################################
# Install Docker Compose v.1.29.2 #
###################################
 curl -SL https://github.com/docker/compose/releases/download/v2.24.5/docker-compose-linux-x86_64 -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
if [ ! -L /usr/bin/docker-compose ]; then 
  sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose
fi
