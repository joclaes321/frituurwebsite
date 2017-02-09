FROM laradock/workspace:1.1

# Add a default user
ARG USERNAME=laravel
ARG PUID=1000
ARG PGID=1000
RUN set -xe \
    && groupadd -g $PGID $USERNAME \
    && useradd -u $PUID -g $USERNAME -m $USERNAME

# set environment to contain composer
ENV PATH="~/.composer/vendor/bin:$PATH"

USER laravel
WORKDIR /app
