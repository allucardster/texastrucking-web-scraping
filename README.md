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