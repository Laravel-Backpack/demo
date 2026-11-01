#!/bin/sh
# Install PHP dependencies on the first start, when the project has no vendor/
# folder yet. Runs before the image's Laravel automations (50-*), which need it.
#
# The Backpack add-ons come from repo.backpackforlaravel.com, so composer needs
# your credentials: an auth.json in the project root, or COMPOSER_AUTH in the
# environment (see docker-compose.yml).
set -e

cd "${APP_BASE_DIR:-/var/www/html}"

if [ -f vendor/autoload.php ]; then
    exit 0
fi

echo "📦 demo: vendor/ is missing, running composer install..."
composer install --no-interaction --no-progress --prefer-dist
