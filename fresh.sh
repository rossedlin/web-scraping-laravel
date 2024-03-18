#!/usr/bin/env bash

#
# Start
#
docker compose down
docker container prune -f
rm -Rf vendor
rm -Rf node_modules

#
# Composer
#
docker compose run web composer install
exit

#
# NPM
#
#docker exec -it web-scraping-laravel-web-1 npm install
#docker exec -it web-scraping-laravel-web-1 npm run dev

#
# Environment File
#
docker exec -it web-scraping-laravel-web-1 php -r "file_exists('.env') || copy('.env.example', '.env');"
docker exec -it web-scraping-laravel-web-1 php artisan key:generate

#
# End
#
docker compose down
