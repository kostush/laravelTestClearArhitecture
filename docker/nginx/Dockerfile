FROM nginx:alpine

COPY nginx.conf /etc/nginx/
#COPY default.conf /etc/nginx/conf.d/

RUN apk update  && apk upgrade && apk add --no-cache bash

ARG PHP_UPSTAREM_CONTAINER=php-fpm
ARG PHP_UPSTAREM_PORT=9000

RUN set -x; \
    addgroup -g 82 -S www-data; \
    adduser -u 82 -D -S -G www-data www-data && exit 0; exit 1

RUN echo "upstream php-upstream {server ${PHP_UPSTAREM_CONTAINER}:${PHP_UPSTAREM_PORT};}" > /etc/nginx/conf.d/upstream.conf    && rm /etc/nginx/conf.d/default.conf

EXPOSE 80