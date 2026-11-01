# Local development image for the Backpack demo.
# Based on serversideup/php v5: https://serversideup.net/open-source/docker-php/
# NGINX + PHP-FPM in one container, listening on 8080 (HTTP) and 8443 (HTTPS).
FROM serversideup/php:8.4-fpm-nginx AS base

USER root

# Extensions the demo needs on top of the image's defaults:
# exif for spatie/image (media library), gd for image fields, intl for
# number/date formatting. mariadb-client gives the backup manager mysqldump.
RUN install-php-extensions exif gd intl \
    && apt-get update \
    && apt-get install -y --no-install-recommends mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# Our own startup scripts, run after the image's Laravel automations.
COPY --chmod=755 ./docker/entrypoint.d/ /etc/entrypoint.d/
# Turn the entrypoint.d scripts into s6 one-shots, so they run before NGINX
# and PHP-FPM start.
RUN docker-php-serversideup-s6-init

USER www-data

FROM base AS development

# Match www-data to the host user, so files the container writes into the
# mounted project (logs, cache, uploads) stay editable on the host.
ARG USER_ID=1000
ARG GROUP_ID=1000

USER root
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID \
    && docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx
USER www-data
