# ================================
# Dockerfile - E-Ticketing Wisata Ende (Laravel)
# ================================

FROM php:8.2-apache

# Install dependensi sistem yang dibutuhkan PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang dibutuhkan Laravel + MySQL
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# Aktifkan mod_rewrite Apache (dibutuhkan untuk routing Laravel)
RUN a2enmod rewrite

# Arahkan Apache document root ke folder public/ milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Copy source code project
COPY . .

# Install dependency PHP (production, tanpa dev dependencies)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy file .env jika belum ada
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Set permission folder storage & bootstrap/cache (wajib agar Laravel bisa menulis log/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]