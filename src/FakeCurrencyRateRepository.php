<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\CurrencyRateRepositoryInterface;

class FakeCurrencyRateRepository implements CurrencyRateRepositoryInterface
{
	/**
	 * @var CurrencyRate[]
	 */
	private $currencyRateList;

	/**
	 * @param CurrencyRate[] $currencyRateList
	 */
	public function __construct(array $currencyRateList)
	{
		$this->currencyRateList = $currencyRateList;
	}

	/**
	 * @param CurrencyPair $currencyPair
	 * @return CurrencyRate|null
	 */
	public function findByCurrencyPair(CurrencyPair $currencyPair): ?CurrencyRate
	{
		$index = $currencyPair->toString();
		if (!key_exists($index, $this->currencyRateList)) {
			return null;
		}
		return $this->currencyRateList[$index];
	}

	/**
	 * @param CurrencyRate $currencyRate
	 */
	public function save(CurrencyRate $currencyRate): void
	{
		$index = $currencyRate->getPair()->toString();
		$this->currencyRateList[$index] = $currencyRate;
	}
}