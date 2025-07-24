# Default user and group IDs, can override
USER_ID ?= 1000
GROUP_ID ?= 1000

# Docker Compose command
DC := docker compose

# Compose files list
COMPOSE_FILES := -f docker-compose.yml \
                 -f vendor/docker-compose.nginx.yml \
                 -f vendor/docker-compose.postgres.yml \
                 -f vendor/docker-compose.redis.yml \
                 -f vendor/docker-compose.rabbitmq.yml

.PHONY: network-create
# Create Docker network if not exists
network-create:
	@if ! docker network ls --format '{{.Name}}' | grep -q '^app-network$$'; then \
		echo "Creating Docker network 'app-network'..."; \
		docker network create app-network; \
	else \
		echo "Docker network 'app-network' already exists."; \
	fi

.PHONY: build
# Build and start containers
build: network-create
	$(DC) $(COMPOSE_FILES) up --build -d --remove-orphans

.PHONY: start
# Start containers
start: network-create
	$(DC) $(COMPOSE_FILES) up -d

.PHONY: stop
# Stop and remove containers and volumes
stop:
	$(DC) $(COMPOSE_FILES) down -v

.PHONY: restart
# Restart containers
restart: stop start

.PHONY: help
# Show help
help:
	@echo "Available commands:"
	@echo "  make network-create - Create Docker network 'app-network' if missing"
	@echo "  make build          - Build and start containers"
	@echo "  make start          - Start containers"
	@echo "  make stop           - Stop and remove containers and volumes"
	@echo "  make restart        - Restart containers"
	@echo ""
	@echo "You can override USER_ID and GROUP_ID when calling, e.g.:"
	@echo "  make build USER_ID=1000 GROUP_ID=1000"