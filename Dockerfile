FROM php:8.2-cli

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    && docker-php-ext-enable redis.so \
    \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /usr/src

