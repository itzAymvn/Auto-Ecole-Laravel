FROM php:8.2-apache

RUN apt-get update && \ 
    apt-get install -y \
    libzip-dev \
    zip \
    wget

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql zip

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY . .

# Set proper ownership and permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

RUN mv .env.example .env

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

# Copy the wait-for-it script
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh

# Set the database host and port
ENV DB_HOST=db
ENV DB_PORT=3306

EXPOSE 80

CMD /usr/local/bin/wait-for-it.sh ${DB_HOST}:${DB_PORT} --timeout=60 --strict -- \
    && php artisan key:generate \
    && php artisan migrate \
    && php artisan db:seed \
    && apache2-foreground
