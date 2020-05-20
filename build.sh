#!/usr/bin/env bash

#
# Composer
#
sudo rm -R vendor
docker run -v $PWD:/var/www -vapi_integration_demo_composer:/root/.composer rossedlin/centos-apache-php:7.1-dev composer install

#
# NPM
#
sudo rm -R node_modules
docker run -v $PWD:/var/www rossedlin/centos-apache-php:7.1-dev npm install
docker run -v $PWD:/var/www rossedlin/centos-apache-php:7.1-dev npm run dev
