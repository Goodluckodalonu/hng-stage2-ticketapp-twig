# Use an official PHP image with Apache
FROM php:8.2-apache

# Install Composer
RUN apt-get update && apt-get install -y unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache modules for .htaccess and URL rewriting
RUN a2enmod rewrite

# Set up Apache to allow .htaccess overrides
RUN echo '<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/allow-htaccess.conf \
    && a2enconf allow-htaccess

# Copy app files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose Render’s default port
EXPOSE 10000

# Run Apache in foreground
CMD ["apache2-foreground"]
