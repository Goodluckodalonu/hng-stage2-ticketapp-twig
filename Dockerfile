FROM php:8.2-apache

# Enable rewrite
RUN a2enmod rewrite

# Copy app
COPY . /var/www/html/

# Set working dir
WORKDIR /var/www/html

# Configure Apache for rewrite
RUN echo "<Directory /var/www/html/> \
    AllowOverride All \
    Require all granted \
</Directory>" > /etc/apache2/conf-available/app.conf \
    && a2enconf app

EXPOSE 80
