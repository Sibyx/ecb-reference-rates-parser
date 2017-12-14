<?php
/**
 * @author            Jakub Dubec <jakub.dubec@gmail.com>
 */

namespace EcbReferenceRates;

use EcbReferenceRates\Models\Rate;
use EcbReferenceRates\Models\RateReference;

class EcbReferenceRatesParser
{
	const PACKAGE_NAME = 'EcbReferenceRatesParser';
	const VERSION = '1.0';

	public static $dataLocation = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";

	/**
	 * @return RateReference
	 */
	public static function parse()
	{
		$xml = simplexml_load_string(file_get_contents(self::$dataLocation));

		$rate_reference = new RateReference(new \DateTime((string) $xml->Cube->Cube['time']));

		foreach ($xml->Cube->Cube->Cube as $item) {
			$rate_reference->addRate(
				new Rate(
					(string) $item['currency'],
					(double) $item['rate']
				)
			);
		}

		return $rate_reference;
	}

	/**
	 * Create library signature from name and version.
	 * @return string
	 */
	public static function getSignature()
	{
		return sprintf("%s/%s", self::PACKAGE_NAME, self::VERSION);
	}
}
