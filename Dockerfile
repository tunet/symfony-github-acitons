FROM php:8.2.8-fpm-alpine3.18

RUN apk update \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        postgresql-dev \
    && apk add --no-cache \
        icu-dev \
        make \
        postgresql-libs \
        postgresql-client \
       	git \
       	bash \
    && apk add --update \
        linux-headers \
    && docker-php-ext-install opcache \
    && pecl update-channels \
    && pecl install \
        apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install intl \
    && pecl clear-cache \
    && rm -rf /tmp/* /var/cache/apk/* \
    && apk del .build-deps \
    && curl -OL https://getcomposer.org/download/2.5.8/composer.phar \
    && mv ./composer.phar /usr/bin/composer \
    && chmod +x /usr/bin/composer \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    &&  mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /srv/app
