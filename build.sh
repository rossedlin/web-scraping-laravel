#!/usr/bin/env bash

#
# Start
#
docker compose down
docker compose up -d

#
# Composer
#
rm -R vendor
docker exec -it web-scraping-laravel-web-1 composer install

#
# NPM
#
#sudo rm -R node_modules
#docker run -v $PWD:/var/www rossedlin/centos-apache-php:7.1-dev npm install
#docker run -v $PWD:/var/www rossedlin/centos-apache-php:7.1-dev npm run dev

#
# End
#
docker compose down
