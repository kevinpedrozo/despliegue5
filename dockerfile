FROM php:8.2-apache

RUN a2enmod rewrite

COPY . /var/www/html/

RUN mkdir -p /var/www/html/data \
    && mkdir -p /var/www/html/uploads \
    && chmod -R 777 /var/www/html/data \
    && chmod -R 777 /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/data \
    && chown -R www-data:www-data /var/www/html/uploads

EXPOSE 80

CMD ["apache2-foreground"]
