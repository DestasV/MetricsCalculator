FROM php:7.2-cli

RUN apt-get update
RUN apt-get install -y git zip zlib1g-dev libssl-dev
RUN docker-php-ext-install bcmath zip
RUN pecl install xdebug
RUN curl http://getcomposer.org/composer.phar > /usr/local/bin/composer && chmod +x /usr/local/bin/composer