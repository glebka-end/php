#!/bin/bash

./artisan down
./artisan migrate
chown -R www-data:www-data storage
./artisan up