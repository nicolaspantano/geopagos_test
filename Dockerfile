# Use an official PHP image with Apache
FROM php:8.2-apache

#Composer
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install required PHP extensions (e.g., pdo, pdo_mysql)
RUN docker-php-ext-install pdo pdo_mysql

# Enable mod_rewrite for Apache (if needed for clean URLs)
RUN a2enmod rewrite

# Copy application files to the container
COPY . /var/www/html

# Set working directory in the container
WORKDIR /var/www/html

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html

RUN composer install

# Expose port 80 for the Apache server
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]