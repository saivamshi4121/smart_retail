# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Install required PHP extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy the current directory contents into the container
COPY . .

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
