FROM php:8.3-apache-bookworm
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
RUN apt-get update && apt-get install -y git zip unzip \
    && rm -rf /var/lib/apt/lists/*
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN { \
  echo "zend_extension=xdebug"; \
  echo "xdebug.mode=develop,debug"; \
  echo "xdebug.start_with_request=yes"; \
  echo "xdebug.discover_client_host=false"; \
  echo "xdebug.client_host=host.docker.internal"; \
  echo "xdebug.client_port=9003"; \
  echo "xdebug.log_level=0"; \
} > /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instal·la les dependències abans d'iniciar Apache en cada arrencada.
CMD ["bash", "-ec", "if [ ! -f composer.json ]; then composer require phpmailer/phpmailer --no-interaction --prefer-dist; else composer install --no-interaction --prefer-dist; fi; a2enmod rewrite; exec apache2-foreground"]
