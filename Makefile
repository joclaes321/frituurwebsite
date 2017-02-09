.PHONY: install
install:
	docker-compose build workspace
	docker-compose run --rm workspace make install_all

.PHONY: install_all
install_all:
	composer install
	php artisan migrate
