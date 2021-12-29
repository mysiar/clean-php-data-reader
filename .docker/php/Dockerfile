FROM php:8.1-fpm

COPY .bashrc /root/.bashrc

RUN apt update && \
    apt install -y --no-install-recommends libssl-dev \
    zlib1g-dev \
    curl \
    g++ \
    git \
    unzip \
    netcat \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    zip  \
    libyaml-dev && \
    pecl install yaml && \
    docker-php-ext-enable yaml


SHELL ["/bin/bash", "-c"]

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

CMD php-fpm

EXPOSE 9000
