FROM php:7.3-fpm-alpine

WORKDIR /var/www/html/

RUN apk --update add --virtual build-dependencies build-base openssl-dev autoconf \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini \
    && apk del build-dependencies build-base openssl-dev autoconf \
    && rm -rf /var/cache/apk/*

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer


COPY . .

RUN composer install

