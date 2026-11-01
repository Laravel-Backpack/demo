#!/usr/bin/env bash
# Start the Docker stack. Extra arguments go to docker compose up (e.g. -d).
docker compose up --remove-orphans "$@"
