docker-up:
	docker compose up -d --build

run-php:
	docker compose exec php bash

composer:
	composer install --no-interaction --no-suggest

run-unit-tests:
	php -d memory_limit=1G vendor/bin/phpunit --testsuite unit

run-integration-tests:
	php bin/console --env=test doctrine:database:drop --force || true
	php bin/console --env=test doctrine:database:create
	php bin/console --env=test doctrine:schema:create
	php -d memory_limit=1G vendor/bin/phpunit --testsuite integration
