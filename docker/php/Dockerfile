FROM php:8.3-fpm-alpine

WORKDIR /var/www

# System dependencies (IMPORTANT: openssl-dev)
RUN apk add --no-cache \
    git \
    curl \
    unzip \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    autoconf \
    g++ \
    make \
    openssl-dev

# PHP extensions
RUN docker-php-ext-install \
    intl \
    mbstring \
    bcmath \
    zip \
    pcntl \
    opcache

# MongoDB extension (NOW WITH SSL)
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
