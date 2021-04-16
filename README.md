Texastrucking Web Scraping
==========================

Requirements
============

- Docker (>= 18.x)
- Docker Compose (>= 1.20)
- Make

Technology Stack
================
- Composer (>= 1.10.X)
- PHP (>= 7.4)

TL;DR
=====
From console execute the following:
```
$~ make up
$~ make composer-install
$~ make scrap-source-csv
docker-compose exec php sh -c 'php -d memory_limit=-1 test_csv.php'
$~ ls -lah
total 2,0M
drwxrwxr-x  7 allucardster allucardster 4,0K abr 15 20:42 .
drwxrwxr-x  9 allucardster allucardster 4,0K abr 15 20:08 ..
-rw-rw-r--  1 allucardster allucardster  598 abr 15 20:08 composer.json
-rw-rw-r--  1 allucardster allucardster 117K abr 15 20:08 composer.lock
drwxrwxr-x  3 allucardster allucardster 4,0K abr 15 20:08 docker
-rw-rw-r--  1 allucardster allucardster  163 abr 15 20:08 docker-compose.yml
-rw-rw-r--  1 allucardster allucardster    9 abr 15 20:08 .dockerignore
drwxrwxr-x  8 allucardster allucardster 4,0K abr 15 20:32 .git
-rw-rw-r--  1 allucardster allucardster   21 abr 15 20:32 .gitignore
drwxrwxr-x  2 allucardster allucardster 4,0K abr 15 20:41 .idea
-rw-rw-r--  1 allucardster allucardster  719 abr 15 20:38 Makefile
-rw-rw-r--  1 allucardster allucardster 1,4K abr 15 20:42 README.md
-rw-r--r--  1 root         root         103K abr 15 20:42 source.csv --->OPEN THIS FILE :)
-rw-rw-r--  1 allucardster allucardster 1,7M abr 15 20:08 source.html
drwxrwxr-x  2 allucardster allucardster 4,0K abr 15 20:26 src
-rw-rw-r--  1 allucardster allucardster  211 abr 15 20:32 test_csv.php
-rw-rw-r--  1 allucardster allucardster  191 abr 15 20:08 test.php
drwxr-xr-x 17 root         root         4,0K abr 15 20:11 vendor

```

if you want to see the JSON data, execute the following:
```
$~ make scrap-source
docker-compose exec php sh -c 'php -d memory_limit=-1 test.php'
[
    {
        "companyName": "Lorem Ipsum Dolor",
        "contactName": "John Doe",
        "contactEmail": "john.doe@example.com",
        "address": "Fake St 1 2 3",
        "phone": "(555) 555-5555",
        "website": "http:\/\/www.example.com",
        "trailerTypes": [
            "Lorem",
            "Ipsum"
        ],
        "commoditiesHauled": [
            "Dolor"
        ]
    },
    ...
]
```

How to use it?
==============

```php
<?php

<?php

require 'vendor/autoload.php';

use Texastrucking\WebScraping\CoMemSearchCrawler;

$crw = new CoMemSearchCrawler(__DIR__ . '/source.html');

$crw->getData(); // return data as php array
$crw->getJsonData(true); // return data as json

?>
```

Contributors
============

- Richard Melo [Github](https://github.com/allucardster), [Twitter](https://twitter.com/allucardster), [Linkedin](https://www.linkedin.com/in/richardmelo)
