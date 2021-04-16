
help: ## show this help
	@echo 'usage: make [target] ...'
	@echo ''
	@echo 'targets:'
	@egrep '^(.+)\:\ .*##\ (.+)' ${MAKEFILE_LIST} | sed 's/:.*##/#/' | column -t -c 2 -s '#'
up: ## up all containers
	docker-compose up -d --remove-orphans
down: ## stop all containers
	docker-compose down
composer-install: ## make composer-install
	docker-compose exec php sh -c 'composer install'
scrap-source: ## parse `source.html` file using `CoMemSearchCrawler and print the json response
	docker-compose exec php sh -c 'php -d memory_limit=-1 test.php'
scrap-source-csv: ## parse `source.html` file using `CoMemSearchCrawler and generate a `source.csv` file
	docker-compose exec php sh -c 'php -d memory_limit=-1 test_csv.php'
