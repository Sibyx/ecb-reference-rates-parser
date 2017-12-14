<?php
/**
 * @author            Jakub Dubec <jakub.dubec@gmail.com>
 */

use EcbReferenceRates\EcbReferenceRatesParser;

require '../vendor/autoload.php';

/** @var \EcbReferenceRates\Models\RateReference $list */
$list = EcbReferenceRatesParser::parse();

printf("Data from %s\n", $list->getDate()->format("Y-m-d"));
printf("JSON representation of RateReference object: %s\n", json_encode($list));

printf("\n");

/** @var \EcbReferenceRates\Models\Rate $rate */
foreach ($list->getRates() as $rate) {
	printf("Currency: %s\n", $rate->getCurrency());
	printf("Rate: %f\n", $rate->getRate());
	printf("String representation of Rate object: %s\n", $rate);
	printf("JSON: %s\n", json_encode($rate));

	printf("\n");
}
