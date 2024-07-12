FROM node:22.4.1 as node_base

FROM serversideup/php:8.3-fpm-nginx as base

COPY --chown=www-data:www-data ./docker/infra/certs /etc/nginx/certs

# uncomment if you need to install chrome. eg. for spatie browser shot projects.
#USER root
# ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD true
#RUN apt-get update \
#    && apt-get install -y wget gnupg \
#    && wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - \
#    && sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list' \
#    && apt-get -y update \
#    && apt-get install -y google-chrome-stable fonts-ipafont-gothic fonts-wqy-zenhei fonts-thai-tlwg fonts-kacst fonts-freefont-ttf libxss1 \
#--no-install-recommends \
#    && rm -rf /var/lib/apt/lists/* \
#    && usermod -a -G video www-data \
#    && usermod -a -G audio www-data \
#    && mkdir -p /home/www-data/Downloads \
#    && chown -R www-data:www-data /home/www-data

FROM base as development

# We can pass USER_ID and GROUP_ID as build arguments
# to ensure the www-data user has the same UID and GID
# as the user running Docker.
ARG USER_ID
ARG GROUP_ID

# Switch to root so we can set the user ID and group ID
USER root

ENV S6_CMD_WAIT_FOR_SERVICES=1

# make npm & node available in the container
COPY --chown=www-data:www-data --from=node_base /usr/local/bin /usr/local/bin
COPY --chown=www-data:www-data --from=node_base /usr/local/lib/node_modules/npm /usr/local/lib/node_modules/npm


COPY --chmod=755 ./docker/entrypoint.d/ /etc/entrypoint.d

RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID  && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

# run the docker-php-serversideup-s6-init script
RUN docker-php-serversideup-s6-init

USER www-data