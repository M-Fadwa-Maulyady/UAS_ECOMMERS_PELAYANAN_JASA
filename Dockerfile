FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev

RUN docker-php-ext-install pdo pdo_mysql gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear || true
RUN php artisan cache:clear || true

CMD php artisan migrate --force \
 && php artisan db:seed --force \
 && php artisan serve --host=0.0.0.0 --port=$PORT
