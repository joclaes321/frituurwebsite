FROM nginx:alpine

ENV NGINX_CONF_DIR=/etc/nginx/conf.d \
    APP_DIR=/app

# Indiciate on which host php-fpm is running
ARG PHP_UPSTREAM=php-fpm:9001

# Copy configuration files to container
COPY ./docker/nginx/nginx.conf /etc/nginx/
COPY ./docker/nginx/laravel.conf ${NGINX_CONF_DIR}/laravel.conf

# Install software
RUN set -xe \
    && apk update \
    && apk upgrade \
    && apk add --no-cache bash \
    && addgroup -S www-data -g 1000 \
    && adduser -S -D -H -u 1000 -s /bin/bash -g www-data www-data \
    && rm ${NGINX_CONF_DIR}/default.conf \
    && echo "upstream php-upstream { server ${PHP_UPSTREAM}; }" > ${NGINX_CONF_DIR}/upstream.conf \
    && mkdir ${APP_DIR} \
    && chmod 2775 ${APP_DIR} && chown -R www-data:www-data ${APP_DIR} \
    && rm -rf /var/cache/apk/*

# Copy source files
COPY ./src ${APP_DIR}

CMD ["nginx"]
EXPOSE 80 443
