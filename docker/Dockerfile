FROM php:8.2-apache-bullseye

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    git

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache modules
RUN a2enmod ssl
RUN a2enmod rewrite

# Install php-mysql driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

# configurazione xdebug
RUN echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer