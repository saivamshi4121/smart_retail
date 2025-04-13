# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . .

# Enable apache mod_rewrite (if needed)
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
