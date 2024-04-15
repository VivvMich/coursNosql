FROM php:8.3-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-install opcache
ADD opcache.ini $PHP_INI_DIR/conf.d/


RUN apt-get -y update \
    && apt-get install -y libssl-dev pkg-config libzip-dev unzip git

RUN pecl install zlib zip mongodb \
    && docker-php-ext-enable zip \
    && docker-php-ext-enable mongodb

# Install composer (updated via entry point)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
