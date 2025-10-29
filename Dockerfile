# Use official PHP with Apache
FROM php:8.2-apache

# Enable URL rewriting and .htaccess
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN echo '<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/allow-htaccess.conf \
    && a2enconf allow-htaccess

# Install system deps & Composer
RUN apt-get update && apt-get install -y unzip curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy everything into web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose Render port
EXPOSE 10000

# Run Apache
CMD ["apache2-foreground"]
