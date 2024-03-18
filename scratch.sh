
# PayPal Laravel
docker compose down
docker container prune -f

if [ -e ~/Projects/web-scraping-laravel-scratch ]; then
    cd ~/Projects/web-scraping-laravel-scratch || exit;

    docker compose down
    docker container prune -f
fi

cd ~/Projects || exit;
rm -Rf ~/Projects/web-scraping-laravel-scratch

## Install

composer create-project laravel/laravel=10.* web-scraping-laravel-scratch
cd ~/Projects/web-scraping-laravel-scratch || exit;

## Git (pre)

git init
git add .
git commit -m "Init"

## Docker (Setup)
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/docker-compose.yml -o docker-compose.yml
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/up.sh -o up.sh
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/down.sh -o down.sh
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/bash.sh -o bash.sh

chmod +x ./*.sh

git add .
git commit -m "Docker"

#
# Composer
#
docker compose run --rm web bash -c "composer require rossedlin/edlin-php:3.0.*"
docker compose run --rm web bash -c "composer require symfony/dom-crawler:^4.4"

#
# Artisan
#
docker compose run --rm web bash -c "php artisan make:controller WebScrapingController"
mkdir ./app/WebScraper
mkdir ./resources/views/layout

#
# GitHub Overrides
#
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/routes/web.php -o ./routes/web.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/routes/api.php -o ./routes/api.php

curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/app/WebScraper/AbstractWebScraper.php -o ./app/WebScraper/AbstractWebScraper.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/app/WebScraper/CodeWithRoss.php -o ./app/WebScraper/CodeWithRoss.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/app/WebScraper/RossEdlin.php -o ./app/WebScraper/RossEdlin.php

curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/app/Http/Controllers/WebScrapingController.php -o ./app/Http/Controllers/WebScrapingController.php

curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/resources/views/index.blade.php -o ./resources/views/index.blade.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/resources/views/table.blade.php -o ./resources/views/table.blade.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/resources/views/table.blade.php -o ./resources/views/table.blade.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/resources/views/layout/default.blade.php -o ./resources/views/layout/default.blade.php

#
# Env
#
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/web-scraping-laravel/master/.env.example -o ./.env.example
docker compose run --rm web bash -c "rm .env; cp .env.example .env; php artisan key:generate"

#
# Git (post)
#
git add .

#
# Docker (Run)
#
docker compose up -d
