#!/usr/bin/env bash

docker compose down --remove-orphans "${args[@]}"
docker compose build
docker compose up --remove-orphans "${args[@]}"