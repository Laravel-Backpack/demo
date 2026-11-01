#!/bin/sh
# Seed the demo data on the first start. Runs after the image's Laravel
# automations (50-*) have migrated the database. A database that already has
# users is left alone, so restarts keep whatever you changed.
#
# To start over: docker compose exec php php artisan migrate:fresh --seed --force
set -e

if [ "${DEMO_SEED_IF_EMPTY:-true}" != "true" ]; then
    exit 0
fi

cd "${APP_BASE_DIR:-/var/www/html}"

users=$(php artisan tinker --execute 'echo "users=".\App\User::count();' 2>/dev/null | sed -n 's/^users=//p')

if [ "$users" = "0" ]; then
    echo "🌱 demo: empty database, seeding the demo data (takes a minute)..."
    php artisan db:seed --force
fi
