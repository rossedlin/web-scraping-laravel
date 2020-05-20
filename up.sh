#!/usr/bin/env bash

docker-compose down
docker pull rossedlin/centos-apache-php:7.1-dev
docker-compose up