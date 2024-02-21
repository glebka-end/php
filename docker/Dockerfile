FROM ubuntu:20.04
ENV DEBIAN_FRONTEND noninteractive \
    LANG C.UTF-8
RUN apt-get update && \
    apt-get install -y --no-install-recommends software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt update && apt install -y apt-utils \
                                net-tools \
                                curl \
                                wget \
                                zip \
                                gnupg2 \
                                ca-certificates \
                                apt-transport-https \
                                iputils-ping \
                                cron \
                                nano \
                                vim \
                                nginx \
                                supervisor \
                                mysql-client \
                                less \
                                openssh-client \
                                php8.2-fpm \
                                php8.2-curl \
                                php8.2-mbstring \
                                php8.2-mysql \
                                php8.2-soap \
                                php8.2-zip \
                                php8.2-xml \
                                php8.2-gd \
                                php8.2-intl \
                                php8.2-pgsql \
                                php8.2-gmp \
                                php8.2-msgpack \
                                libpng-dev \
                                libzip-dev

RUN mkdir -p /var/www/api /run/php /var/log/supervisor
WORKDIR /var/www/api
COPY . /var/www/api
COPY ./docker/nginx.conf /etc/nginx/sites-available/default
# COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN echo 'clear_env = no' >> /etc/php/8.2/fpm/pool.d/www.conf && \
    curl -sS https://getcomposer.org/installer | php -- --version=2.3.4 --install-dir=/bin --filename=composer --quiet && composer install && \
    cp .env.example .env && php artisan key:generate && \
    chown -R www-data:www-data storage/ bootstrap/cache/ && \
    chmod -R 755 storage/ bootstrap/cache/
