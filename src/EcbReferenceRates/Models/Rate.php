<?php
/**
 * @author            Jakub Dubec <jakub.dubec@gmail.com>
 */

namespace EcbReferenceRates\Models;

class Rate implements \JsonSerializable
{
	/**
	 * @var string
	 */
	private $currency;

	/**
	 * @var double
	 */
	private $rate;

	/**
	 * Rate constructor.
	 * @param string $currency
	 * @param float $rate
	 */
	public function __construct($currency, $rate)
	{
		$this->currency = $currency;
		$this->rate = $rate;
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @return float
	 */
	public function getRate()
	{
		return $this->rate;
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize()
	{
		return [
			'currency' => (string) $this->currency,
			'rate' => (double) $this->rate
		];
	}

	public function __toString()
	{
		return sprintf("%s (%.4f)", $this->currency, $this->rate);
	}
}
