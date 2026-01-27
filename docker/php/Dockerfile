# syntax=docker/dockerfile:1

FROM php:8.2-fpm-alpine

#mama dapu eka
# Add this line to fix the download error
RUN sed -i 's/dl-cdn.alpinelinux.org/dl-4.alpinelinux.org/g' /etc/apk/repositories

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    bash \
    curl \
    git \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    shadow \
    zip \
    unzip \
    supervisor \
  && docker-php-ext-configure gd --with-jpeg --with-freetype \
  && docker-php-ext-install \
    bcmath \
    gd \
    intl \
    opcache \
    pdo_mysql \
    zip \
  && apk del shadow

# Install composer from the official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy custom PHP configuration
COPY docker/php/php.ini /usr/local/etc/php/conf.d/laravel.ini

# Default command runs php-fpm (entrypoint may override)
CMD ["php-fpm"]
