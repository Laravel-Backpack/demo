#!/usr/bin/env bash

# if env file exists abort
if [ -f .env ]; then
    echo "Env file already exists. Use the start.sh script to start the project."
    exit 1
fi

# copy the env file
cp .env.docker.example .env

# Install the dependencies
composer install --no-interaction --ansi

# remove backpack packages and install with --prefer-source so they are cloned from the git repositories
# comment the following line if you are not a backpack maintainer.
rm -rf vendor/backpack

composer install --no-interaction --prefer-source --ansi

php artisan key:generate 

bash start.sh
