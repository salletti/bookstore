ifndef APP_ENV
        include .env
endif

PROJECT			  = "Bookstore"
COLOR_RESET       = \033[0m
COLOR_ERROR       = \033[31m
COLOR_INFO        = \033[32m
COLOR_COMMENT     = \033[33m
COLOR_TITLE_BLOCK = \033[0;44m\033[37m
DOCKER_APP        = docker-compose exec php
DOCKER_NODE		  = docker run -it --rm -v $(PWD):/app:rw,cached -v $(PWD):/node_modules:rw,cached -w /app node:10-alpine
ENV			      = dev

## Help
help:
	@printf "${COLOR_TITLE_BLOCK}${PROJECT} Makefile${COLOR_RESET}\n"
	@printf "\n"
	@printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	@printf " make [target]\n\n"
	@printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	@awk '/^[a-zA-Z\-\_0-9\@]+:/ { \
		helpLine = match(lastLine, /^## (.*)/); \
		helpCommand = substr($$1, 0, index($$1, ":")); \
		helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
		printf " ${COLOR_INFO}%-16s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

vendor: composer.lock
	$(DOCKER_APP) composer install

node_modules: yarn.lock
	$(DOCKER_NODE) yarn install

## Clean the project
clean: kill
	rm -rf .env vendor/* node_modules/* public/assets/build/* public/assets/bundles/*

## Build the assets
assets: node_modules
	$(DOCKER_NODE) yarn run dev

## Launch assets watch.
watch-assets: node_modules
	$(DOCKER_NODE) sh -c "yarn run watch"

## Launch assets watch with Encore.
watch-assets-encore: node_modules
	$(DOCKER_NODE) sh -c "yarn encore dev --watch"

## Builds the db
db: .env vendor
	$(DOCKER_APP) bin/console doctrine:schema:drop --force --no-interaction
	$(DOCKER_APP) bin/console doctrine:schema:create --no-interaction
	$(DOCKER_APP) bin/console hautelook:fixtures:load --no-interaction --purge-with-truncate -vvv


phpcs: ## phpcs
phpcs:
	$(DOCKER_APP) php vendor/bin/phpcs --standard=psr2 --extensions=php --error-severity=1 --warning-severity=8 src/
