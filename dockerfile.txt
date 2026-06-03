FROM php:8.2-apache

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar todo el proyecto al servidor web
COPY . /var/www/html/

# Crear carpetas necesarias
RUN mkdir -p /var/www/html/data \
    && mkdir -p /var/www/html/uploads

# Dar permisos de escritura
RUN chmod -R 777 /var/www/html/data \
    && chmod -R 777 /var/www/html/uploads

# Exponer puerto 80
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
