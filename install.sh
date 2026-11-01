#!/usr/bin/env bash
# First-time setup with Docker: creates .env, builds and starts the stack, and
# generates the app key. Composer, migrations and the demo data run inside the
# container on its first start (docker/entrypoint.d).
#
#   bash install.sh            install the Backpack packages from dist (default)
#   bash install.sh --source   Backpack maintainers: clone the Backpack packages
#                              from git instead, so you can work on them in vendor/
set -euo pipefail

if [ ! -f .env ]; then
    cp .env.docker.example .env
    echo "Created .env from .env.docker.example."
fi

if [ "${1:-}" = "--source" ]; then
    docker compose run --rm --no-deps --entrypoint "" php \
        sh -c 'rm -rf vendor/backpack && composer install --no-interaction --prefer-source'
fi

docker compose build

# Same format as php artisan key:generate, which can't run before vendor/ exists.
if ! grep -qE '^APP_KEY=.+' .env; then
    key=$(docker compose run --rm --no-deps --entrypoint "" php php -r 'echo "base64:".base64_encode(random_bytes(32));')
    sed -i "s#^APP_KEY=.*#APP_KEY=${key}#" .env
    echo "Generated APP_KEY."
fi

docker compose up -d --wait

echo
echo "Ready: http://localhost:$(docker compose port php 8080 | sed 's/.*://')  (admin@example.com / admin)"
echo "Mail:  http://localhost:$(docker compose port mailpit 8025 | sed 's/.*://')"
