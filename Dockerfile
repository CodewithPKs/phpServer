# Use the official PHP image
FROM php:7.4-apache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . /var/www/html/

# Install dependencies
RUN composer install

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Expose port 80
EXPOSE 80