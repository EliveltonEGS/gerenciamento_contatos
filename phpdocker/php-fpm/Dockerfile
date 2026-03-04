FROM phpdockerio/php:8.1-fpm

WORKDIR /application

# Instala dependências do sistema e extensões PHP
RUN apt-get update && apt-get -y --no-install-recommends install \
    php8.1-mysql \
    php8.1-xdebug \
    curl \
    unzip \
    git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Opcional: garante permissões corretas
RUN composer --version