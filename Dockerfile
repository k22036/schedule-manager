FROM php:8.3.9-apache

# install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    zip \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip

# install nodejs and npm
RUN apt-get install -y nodejs npm

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# setting composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME "/opt/composer"
ENV PATH "$PATH:/opt/composer/vendor/bin"

# install laravel
RUN composer global require "laravel/installer"

# Set DocumentRoot to Laravel's public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Ensure storage directory exists and has the correct permissions
RUN mkdir -p /var/www/html/storage && chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/storage

# install pdo_mysql
RUN docker-php-ext-install pdo_mysql

# copy laravel project
WORKDIR /var/www/html
COPY . /var/www/html

# set permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Composer の依存関係のインストール
RUN composer install

# Node.js の依存関係のインストールとビルド
RUN npm install --save-dev vite vite-plugin-laravel
RUN npm run build

# Laravel Breeze のインストール（必要な場合）
RUN composer require laravel/breeze --dev

EXPOSE 8000