# syntax = docker/dockerfile:1.0-experimental

FROM php:8.1-fpm-alpine3.16

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV LANG=en_US.UTF-8 \
    LANGUAGE=en_US.UTF-8 \
    COMPOSER_MEMORY_LIMIT=-1

RUN apk add --no-cache libxml2 libxml2-dev bash && \
    docker-php-ext-install -j$(nproc) soap

RUN deluser www-data
RUN adduser -D -H -u 1000 -s /bin/bash www-data

WORKDIR /var/www/html/
USER www-data

