#!/usr/bin/env bash
# Rebuild the image and restart the Docker stack, e.g. after editing the
# Dockerfile. The database volume is kept. Extra arguments go to docker compose up.
docker compose down --remove-orphans
docker compose build --pull
docker compose up --remove-orphans "$@"
