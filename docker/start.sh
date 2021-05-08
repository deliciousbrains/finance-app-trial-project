#!/bin/bash

docker-compose up -d
sleep 5
docker-compose exec deliciousbrains-app php artisan migrate
docker-compose exec deliciousbrains-app php artisan db:seed
