#!/usr/bin/env bash

docker run -v $PWD:/var/www rossedlin/centos-apache-php:7.1 composer create-project --prefer-dist laravel/laravel stripe-demo