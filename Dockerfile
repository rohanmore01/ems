FROM php:apache

WORKDIR /var/www/html

RUN apt-get update && apt-get upgrade -y;
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli;

RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

COPY . .

EXPOSE 80

CMD ["apache2-foreground"]