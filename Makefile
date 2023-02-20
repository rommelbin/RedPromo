build:
	docker-compose build

DOCKER_COMPOSER := docker run --rm --interactive --tty --workdir /app --user $(shell id -u):$(shell id -g)
COMPOSER_COMMAND := composer --ignore-platform-reqs

composer-install/backend:
	${DOCKER_COMPOSER} --volume $(shell pwd)/backend:/app ${COMPOSER_COMMAND} install
composer-update/backend:
	${DOCKER_COMPOSER} --volume ${shell pwd}/:/app ${COMPOSER_COMMAND} update

up:
	docker-compose up

up/migrate:
	docker-compose run --rm backend sh -c "/wait && php artisan migrate --force --seed"

#up/migrate:
#	docker-compose run --rm backend sh -c "/wait && php artisan migrate --force --seed"
#up/migrate/fresh:
#	docker-compose run --rm backend sh -c "/wait && php artisan migrate:fresh --force --seed"