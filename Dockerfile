FROM php:8.2-apache

# =====================
# FIX MPM CONFLICT (FINAL)
# =====================
RUN rm -f /etc/apache2/mods-enabled/mpm_event.load \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.load \
    && rm -f /etc/apache2/mods-enabled/mpm_prefork.load

RUN a2enmod mpm_prefork rewrite

# =====================
# DEPENDENCIES
# =====================
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo pdo_mysql gd

# =====================
# APACHE ROOT → LARAVEL PUBLIC
# =====================
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# =====================
# LARAVEL
# =====================
WORKDIR /var/www/html
COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
