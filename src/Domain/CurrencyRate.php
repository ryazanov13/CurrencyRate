<?php

namespace CurrencyRate\Domain;

class CurrencyRate
{
	/**
	 * @var CurrencyPair
	 */
	private $pair;
	/**
	 * @var float
	 */
	private $ask;

	/**
	 * @param CurrencyPair $pair
	 * @param float $ask
	 */
	public function __construct(
		CurrencyPair $pair,
		float $ask
	) {
		$this->pair = $pair;
		$this->ask = $ask;
	}

	/**
	 * @return CurrencyPair
	 */
	public function getPair(): CurrencyPair
	{
		return $this->pair;
	}

	/**
	 * @return float
	 */
	public function getAsk(): float
	{
		return $this->ask;
	}

	/**
	 * @param CurrencyRate $currencyRate
	 * @return bool
	 */
	public function equals(CurrencyRate $currencyRate): bool
	{
		return ($this->getAsk() == $currencyRate->getAsk())
			&& ($this->getPair()->toString() == $currencyRate->getPair()->toString());
	}
}