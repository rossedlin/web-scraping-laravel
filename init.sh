#!/usr/bin/env bash

#
# Start
#
docker compose down
docker compose up -d

#
# Environment File
#
docker exec -it web-scraping-laravel-web-1 php -r "file_exists('.env') || copy('.env.example', '.env');"
docker exec -it web-scraping-laravel-web-1 php artisan key:generate

#
# End
#
docker compose down
