#!/bin/sh
docker-compose up -d && \
composer install && \
cd app && php bin/console doctrine:migrations:migrate && \
symfony server:start
