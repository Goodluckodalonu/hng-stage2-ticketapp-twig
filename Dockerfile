# Use an official PHP image with Apache
FROM php:8.2-apache

# Install Composer
RUN apt-get update && apt-get install -y unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy app files to the Apache web directory
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Apache listens on Render’s dynamic port
EXPOSE 10000

# Set the port for Apache
ENV PORT=10000

# Run Apache in the foreground
CMD ["apache2-foreground"]
