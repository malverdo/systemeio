# Linux установка "sudo apt install make"
# Example use "make start"

# Первый запуск

# Первый запуск
first-start: build up composer migrations fixture

# Разборка сборка полностью
init: down build pull up

# Остановить запустить
restart: stop start

# Частичная разборка сборка
restart-up: down up


composer:
	docker exec systemeio_php composer install

migrations:
	docker exec systemeio_php php bin/console doctrine:migrations:migrate

fixture:
	docker exec systemeio_php php bin/console doctrine:fixtures:load -n

start:
	docker-compose start

stop:
	docker-compose stop

up:
	docker-compose up -d

pull:
	docker-compose pull

build:
	docker-compose build

down:
	docker-compose down --remove-orphans