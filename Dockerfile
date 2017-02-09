FROM php:7.0-fpm-alpine

ENV SRC_DIR=/app/src

RUN set -xe \
    && apk --no-cache add curl \
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

# Create working directories
RUN set -xe \ 
    && mkdir -p ${SRC_DIR}

# Copy source to container
COPY ./src/ ${SRC_DIR}

# Link configuration files
RUN set -xe \
    && cp ${SRC_DIR}/laravel.ini /usr/local/etc/php/conf.d/ \
    && cp ${SRC_DIR}/laravel.pool.conf /usr/local/etc/php-fpm.d/

# Set workdir and expose port
WORKDIR ${SRC_DIR}
EXPOSE 8000
