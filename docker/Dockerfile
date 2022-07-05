FROM php:8.1-fpm-alpine

ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    # imagemagick-dev \
    libtool \
    libxml2-dev \
    && apk add --no-cache \
    bash \
    curl \
    freetype-dev \
    g++ \
    gcc \
    libzip-dev \
    oniguruma-dev \
    zlib-dev \
    && docker-php-ext-install \
    bcmath \
    curl \
    mbstring \
    pcntl \
    xml \
    zip \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \ 
    && apk del -f .build-deps

WORKDIR /var/www
EXPOSE 9000
# CMD php artisan serve --host=127.0.0.1 --port=9000
CMD ["php-fpm"]