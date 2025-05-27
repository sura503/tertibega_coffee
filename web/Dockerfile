# Use official PHP image with Apache
FROM php:8.1-apache

# Install any necessary PHP extensions (add more as needed)
RUN docker-php-ext-install mysqli

# Copy project files into the container
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose Apache port
EXPOSE 80
