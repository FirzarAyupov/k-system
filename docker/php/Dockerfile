FROM php:8.3-fpm

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer:2.2 /usr/bin/install-php-extensions /usr/bin/

RUN apt-get update && apt-get install -y --no-install-recommends unzip

RUN install-php-extensions zip pdo_pgsql amqp intl gd xdebug

WORKDIR /var/www/html

CMD ["php-fpm"]
