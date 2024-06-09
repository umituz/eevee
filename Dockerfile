# Temel imaj olarak PHP 8.3 CLI kullanıyoruz
FROM php:8.3-cli

# Çalışma dizinini ayarla
WORKDIR /var/www/html

# Gerekli PHP uzantılarını yükle
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
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install pdo pdo_pgsql zip

# Composer kurulumunu yap
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Mevcut uygulama dosyalarını kopyala
COPY . .

# Composer bağımlılıklarını yükle (sadece production bağımlılıkları)
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress --no-interaction

# Gerekli veriyi volumes ile paylaşmak için
VOLUME /var/www/html/vendor

# Varsayılan komut
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
