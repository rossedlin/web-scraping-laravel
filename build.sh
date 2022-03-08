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
#rm -R node_modules
#docker exec -it web-scraping-laravel-web-1 npm install
#docker exec -it web-scraping-laravel-web-1 npm run dev

#
# End
#
docker compose down
