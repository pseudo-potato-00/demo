# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Enable SSL and mysqli extensions (required for TiDB)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all project files into the container
COPY . /var/www/html/

# Expose Render’s required port
EXPOSE 10000

# Change Apache port from 80 → 10000
RUN sed -i 's/80/10000/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Start Apache in foreground mode
CMD ["apache2-foreground"]
