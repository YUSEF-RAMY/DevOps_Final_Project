# ============================================
# Stage 1: Build frontend assets with Node.js
# ============================================
FROM node:20-alpine AS node-builder

WORKDIR /build

# Copy package files first (cache npm install layer)
COPY package.json package-lock.json ./

RUN npm ci

# Copy frontend source files needed by Vite
COPY vite.config.js ./
COPY resources/ ./resources/

# Build production assets
RUN npm run build


# ============================================
# Stage 2: Install PHP dependencies
# ============================================
FROM composer:2 AS composer-builder

WORKDIR /build

# Copy composer files first (cache composer install layer)
COPY composer.json composer.lock ./

# Install dependencies without dev packages
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --no-autoloader \
    --prefer-dist

# Faker is needed for database seeding (factories use it)
RUN composer require fakerphp/faker --no-interaction --no-scripts --prefer-dist

# Copy full source for autoload generation
COPY . .

# Generate optimized autoloader
RUN composer dump-autoload --optimize


# ============================================
# Stage 3: Production image (PHP 8.4-FPM)
# ============================================
FROM php:8.4-fpm AS production

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        bcmath \
        opcache \
        pcntl \
        zip \
        intl \
        mbstring

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /tmp/pear

# Configure PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# PHP performance tuning
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/99-custom.ini

# PHP-FPM tuning — handle more concurrent requests
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/zz-docker.conf

WORKDIR /var/www/html

# Copy application source code
COPY . .

# Remove stale bootstrap cache that references dev-only providers (e.g. Sail)
RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php bootstrap/cache/config.php

# Copy built assets from node stage
COPY --from=node-builder /build/public/build/ ./public/build/

# Copy vendor from composer stage
COPY --from=composer-builder /build/vendor/ ./vendor/

# Copy the docker environment file as .env
COPY .env.docker .env

# Create a pristine backup of public/ so the entrypoint can populate
# the shared Docker volume on first boot (named volumes start empty)
RUN cp -r public public-base

# Create required directories
RUN mkdir -p \
    storage/app/public/products \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Set permissions — www-data owns everything it needs to write to
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Make entrypoint executable
RUN chmod +x docker/entrypoint.sh

# Expose PHP-FPM port
EXPOSE 9000

# Entrypoint handles migrations, seeding, and starts PHP-FPM
ENTRYPOINT ["docker/entrypoint.sh"]
