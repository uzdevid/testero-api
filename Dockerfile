FROM php:8.1-fpm-alpine

WORKDIR /app

COPY . .

RUN chown -R www-data:www-data /app

RUN apk update && apk add postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

RUN apk add --no-cache libpng libpng-dev libjpeg-turbo libjpeg-turbo-dev freetype freetype-dev libwebp libwebp-dev zlib zlib-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

RUN docker-php-ext-install gd

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

RUN composer install
