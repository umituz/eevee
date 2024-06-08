# Eevee Dockerfile

FROM php:8.3-cli

# Set working directory
WORKDIR /var/www/html

# Install necessary system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install pdo pdo_mysql zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the existing application directory contents
COPY . .

# Install composer dependencies
RUN composer install

# Expose port 80
EXPOSE 80

# Start the application (bu komutu ihtiyacınıza göre güncelleyin)
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
