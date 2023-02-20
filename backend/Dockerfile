FROM alpine/git:v2.36.2 as wait
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.8.0/wait /wait

FROM php:8.1.6-alpine
ARG DEBUG='false'
ARG RUN_DEPS='postgresql-libs'
ARG BUILD_DEPS='postgresql-dev'
ARG PHP_EXTENSIONS='sockets pcntl pdo_pgsql'
ARG UID=1000

# Validate args
RUN if [ $DEBUG != 'true' && $DEBUG != 'false' ]; then echo 'DEBUG argument must be `true` or `false`!'; exit 1; fi

RUN echo 'UTC' > /etc/timezone
COPY --from=wait /wait /.
RUN chmod +x /wait
RUN apk add --no-cache --virtual .build-deps $BUILD_DEPS \
    && docker-php-ext-install -j "$(nproc)" $PHP_EXTENSIONS \
    && apk del .build-deps
RUN apk add --no-cache --virtual .run-deps $RUN_DEPS
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.json .
COPY composer.lock .
RUN composer install --no-autoloader
COPY . .
RUN chown -R $UID:$UID /app
RUN composer dump-autoload

EXPOSE 8000

CMD /wait && php artisan serve --host 0.0.0.0
