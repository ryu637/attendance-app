FROM php:8.2-apache

# 必要なPHP拡張モジュールをインストール
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip gd

# Apacheのmod_rewrite有効化
RUN a2enmod rewrite

# Composerインストール
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# vhost.conf を Apache 設定にコピー
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
