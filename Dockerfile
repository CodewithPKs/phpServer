# Use the official PHP image
FROM php:7.4-apache

# Copy application files to the container
COPY . /var/www/html/

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Set the default directory index
RUN echo "DirectoryIndex callapi.php" >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80