FROM php:7.3-fpm

ENV DEBIAN_FRONTEND=noninteractive
ENV APP_HOME /var/www/html

ARG USER_ID
ARG GROUP_ID

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    apt-utils
RUN apt-get install -y --no-install-recommends \
    subversion \
    git \
    zip \
    unzip \
    libzip-dev \
    zlib1g-dev \
    libbz2-dev \
    libcurl3-dev \
    libcurl4-openssl-dev \
    libexif-dev \
    libxml2-dev

RUN pecl install -o -f xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install bcmath \
    bz2 \
    calendar \
    exif \
    gettext \
    intl \
    mbstring \
    mysqli \
    opcache \
    pcntl \
    pdo_mysql \
    sockets \
    xml \
    zip

# Install composer
RUN apt-get clean && apt-get autoremove -y && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* && \
    curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

WORKDIR "/var/www/rest"

RUN usermod -o -u 1000 www-data && groupmod -o -g 1000 www-data

RUN chown -R www-data:www-data /var/www

USER www-data
