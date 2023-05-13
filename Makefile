setup:
	@make build
	@make up 
	@make composer-install
	@make composer-autoload
	@make data
	@make seed-all
	@make optimize-clear
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-install:
	docker exec app bash -c "composer install"
composer-autoload:
	docker exec app bash -c "composer dump-autoload"
composer-update:
	docker exec app bash -c "composer update"
data:
	docker exec app bash -c "php artisan migrate"
seed-all:
	docker exec app bash -c "php artisan db:seed"
config-cache:
	docker exec app bash -c "php artisan config:cache"
route-clear:
	docker exec app bash -c "php artisan route:clear"
view-clear:
	docker exec app bash -c "php artisan view:clear"
optimize-clear:
	docker exec app bash -c "php artisan optimize:clear"
migrate-fresh:
	docker exec app bash -c "php artisan migrate:fresh"
translation-import:
	docker exec app bash -c "php artisan translations:import --fresh"
translation-export:
	docker exec app bash -c "php artisan translations:export"
