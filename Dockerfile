FROM dunglas/frankenphp:php8.3

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

WORKDIR /app

COPY . .

RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install --no-dev --optimize-autoloader

EXPOSE 8080

ENV PORT=8080

CMD sh -c "frankenphp php-server -r /app/webroot --listen :${PORT}"
