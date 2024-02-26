#!/bin/bash


DATABASE=${DB_DATABASE:-`grep '^DB_DATABASE=' "${PWD}/.env" | cut -d "=" -f2`}
USERNAME=${DB_USERNAME:-`grep '^DB_USERNAME=' "${PWD}/.env" | cut -d "=" -f2`}
PASSWORD=${DB_PASSWORD:-`grep '^DB_PASSWORD=' "${PWD}/.env" | cut -d "=" -f2`}
HOST=${DB_HOST:-`grep '^DB_HOST=' "${PWD}/.env" | cut -d "=" -f2`}
PORT=${DB_PORT:-`grep '^DB_PORT=' "${PWD}/.env" | cut -d "=" -f2`}

CREATE_DATABASE_SQL="CREATE DATABASE IF NOT EXISTS ${DATABASE}  character set 'utf8mb4' collate 'utf8mb4_unicode_ci';"
CREATE_USER_SQL="CREATE USER IF NOT EXISTS '${USERNAME}'@'%' IDENTIFIED BY '${PASSWORD}';"
GRANT_PRIVILEGES_SQL="GRANT ALL PRIVILEGES ON ${DATABASE}.* TO '${USERNAME}'@'%';GRANT RELOAD ON *.* TO '${USERNAME}'@'%';FLUSH PRIVILEGES;"

mysql --protocol=TCP -u root -pmysql -h ${HOST} --port=${PORT} --execute="${CREATE_DATABASE_SQL}"
mysql --protocol=TCP -u root -pmysql -h ${HOST} --port=${PORT} --execute="${CREATE_USER_SQL}"
mysql --protocol=TCP -u root -pmysql -h ${HOST} --port=${PORT} --execute="${GRANT_PRIVILEGES_SQL}"