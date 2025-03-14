FROM php:7.4.9-fpm

# PHP設定ファイルのコピー
COPY php.ini /usr/local/etc/php/

# 必要なライブラリ・拡張のインストール
RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip libjpeg-dev libpng-dev libfreetype6-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql zip gd

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

# 作業ディレクトリ指定
WORKDIR /var/www
