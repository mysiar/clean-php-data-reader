composer:
	docker-compose -f .docker/docker-compose.yml exec php composer install

start:
	docker-compose -f .docker/docker-compose.yml up -d
	@$(MAKE) composer

stop:
	docker-compose -f .docker/docker-compose.yml stop

down:
	docker-compose -f .docker/docker-compose.yml down

clean:
	docker-compose -f .docker/docker-compose.yml exec php rm -rf vendor
	docker-compose -f .docker/docker-compose.yml exec php rm -rf .phpunit.cache
	docker-compose -f .docker/docker-compose.yml exec php rm -rf composer.lock
	@$(MAKE) down

cs-check:
	./vendor/bin/ecs check src tests public

cs-fix:
	./vendor/bin/ecs check src tests public --fix

test:
	@$(MAKE) composer
	docker-compose -f .docker/docker-compose.yml exec php ./vendor/bin/phpunit --testdox --verbose --stop-on-failure

test-full:
	@$(MAKE) cs-check
	@$(MAKE) test
