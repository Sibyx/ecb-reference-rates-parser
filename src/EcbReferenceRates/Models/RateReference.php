<?php
/**
 * @author            Jakub Dubec <jakub.dubec@gmail.com>
 */

namespace EcbReferenceRates\Models;

class RateReference implements \JsonSerializable
{
	/**
	 * @var \DateTime
	 */
	private $date;

	/**
	 * @var Rate[]
	 */
	private $items;

	/**
	 * RateReference constructor.
	 * @param \DateTime $date
	 * @param Rate[] $items
	 */
	public function __construct(\DateTime $date, array $items = [])
	{
		$this->date = $date;

		foreach ($items as $item) {
			if ($item instanceof Rate) {
				$this->items[$item->getCurrency()] = $item;
			}
		}
	}

	public function getRates()
	{
		return $this->items;
	}

	/**
	 * @param $currency
	 * @return bool|Rate
	 */
	public function getRate($currency)
	{
		return !empty($this->items[$currency]) ? $this->items[$currency] : false;
	}

	public function addRate(Rate $rate)
	{
		$this->items[$rate->getCurrency()] = $rate;
	}

	/**
	 * @return \DateTime
	 */
	public function getDate()
	{
		return $this->date;
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
			'date' => $this->date->format(DATE_ISO8601),
			'rates' => $this->items
		];
	}
}
