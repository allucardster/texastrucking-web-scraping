up: ## up all containers
	docker-compose up -d --remove-orphans
down: ## stop all containers
	docker-compose down
composer-install: ## make composer-install
	docker-compose exec php sh -c 'composer install'
scrap-source: ## parse `source.html` file using `CoMemSearchCrawler
	docker-compose exec php sh -c 'php -d memory_limit=-1 test.php'
