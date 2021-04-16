scrap-source: ## parse `source.html` file using `CoMemSearchCrawler
	docker-compose exec php sh -c 'php -d memory_limit=-1 test.php'