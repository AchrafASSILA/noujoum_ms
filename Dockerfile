# Dockerfile

# Use the official PHP image with Composer
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application directory permissions
COPY . .

# Install Laravel dependencies
RUN composer install --ignore-platform-req=ext-zip --optimize-autoloader --no-dev 

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Install Vue.js dependencies
RUN npm install

# Build the Vue.js application
RUN npm run build

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
