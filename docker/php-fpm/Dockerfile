FROM php:7-fpm-alpine

ENV SRC_DIR=/app

RUN set -xe \
    && if ! grep -q 'testing' /etc/apk/repositories; then \
           echo http://nl.alpinelinux.org/alpine/edge/testing >> /etc/apk/repositories; fi \
    && apk --no-cache add curl \
                          shadow \
                          coreutils \
                          build-base \
                          libmemcached-dev \
                          zlib-dev \
                          postgresql-dev \
                          jpeg-dev \
                          libpng-dev \
                          freetype-dev \
                          openssl-dev \
                          autoconf \
                          libmcrypt-dev \
    && max_procs=$(nproc) \
    && docker-php-ext-install -j$max_procs mcrypt pdo_mysql pdo_pgsql \
    && docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-jpeg-dir=/usr/lib \
        --with-freetype-dir=/usr/include/freetype2 \
    && docker-php-ext-install -j$max_procs gd

# Copy configuration files
COPY ./docker/php-fpm/laravel.ini /usr/local/etc/php/conf.d/
COPY ./docker/php-fpm/laravel.pool.conf /usr/local/etc/php-fpm.d/

# Source files
RUN set -xe \
    && mkdir $SRC_DIR \
    && usermod -u 1000 www-data && groupmod -g 1000 www-data \
    && chown www-data $SRC_DIR \
    && chmod 2775 $SRC_DIR

# Copy source files
COPY ./src ${SRC_DIR}

EXPOSE 9001 9000
CMD ['php-fpm']
