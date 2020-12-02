# Get node, compile assets
FROM node:alpine AS assets

# Set working directory
WORKDIR /var/www

# Copy assets
COPY . .

# Install npm packages
RUN npm i

# Compile assets
RUN npm run production

# PHP stuff
FROM php:fpm
WORKDIR /var/www
COPY --from=assets /var/www /var/www

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Upgrade packages
RUN composer upgrade

# Install packages
RUN composer install

# Run migrations and seeds
# RUN php artisan migrate:fresh --seed

EXPOSE 80
USER ${user}