FROM php:7.4.10-apache

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y apt-utils

RUN apt-get install -y \
        curl \
        nano \
        sudo \
        wget \
        zip \
        unzip
        
RUN apt-get install -y default-mysql-client \
    && docker-php-ext-install -j$(nproc) pdo_mysql

RUN apt-get install -y \
        sqlite3 \
        libsqlite3-dev

RUN apt-get install -y libzip-dev \
    && docker-php-ext-install -j$(nproc) zip

RUN apt-get install -y libicu-dev \
    && docker-php-ext-install -j$(nproc) intl

RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN php -r 'readfile("https://getcomposer.org/installer");' > composer-setup.php \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && rm -f composer-setup.php \
  && chown www-data:www-data /var/www

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
  && apt-get install -y nodejs \
  && npm install -g yarn

RUN apt-get clean \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"