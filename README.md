# ECB Reference Rates Parser

A simple PHP library for parsing current reference rates from [European Central Bank](http://www.ecb.europa.eu) stored in [remote XML file](http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml).

## Installation

```bash
composer install sibyx/ecb-reference-rates-parser
```

## Usage example

```php
<?php

use EcbReferenceRates\EcbReferenceRatesParser;

require 'vendor/autoload.php';

/** @var \EcbReferenceRates\Models\RateReference $list */
$list = EcbReferenceRatesParser::parse();

printf("Data from %s\n", $list->getDate()->format("Y-m-d"));
printf("JSON representation of RateReference object: %s\n", json_encode($list));

printf("\n");

/** @var \EcbReferenceRates\Models\Rate $rate */
foreach ($list->getRates() as $rate)
{
	printf("Currency: %s\n", $rate->getCurrency());
	printf("Rate: %f\n", $rate->getRate());
	printf("String representation of Rate object: %s\n", $rate);
	printf("JSON: %s\n", json_encode($rate));

	printf("\n");
}
```

## Contributors
 
 - [Jakub Dubec](https://github.com/Sibyx) - Initial works, maintenance
  
I wrote this library as part of my job in [Backbone s.r.o.](https://www.backbone.sk/en/).

## License

This project is licensed under the terms of the MIT license.