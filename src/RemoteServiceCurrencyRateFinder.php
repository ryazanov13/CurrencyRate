<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\CurrencyRateFinderInterface;

class RemoteServiceCurrencyRateFinder implements CurrencyRateFinderInterface
{
	/**
	 * @var CurrencyRateFinderInterface
	 */
	private $currencyRateFinder;

	/**
	 * @param CurrencyRateFinderInterface $currencyRateFinder
	 */
	public function __construct(CurrencyRateFinderInterface $currencyRateFinder)
	{
		$this->currencyRateFinder = $currencyRateFinder;
	}

	/**
	 * @param CurrencyPair $currencyPair
	 * @return CurrencyRate|null
	 */
	public function findByCurrencyPair(CurrencyPair $currencyPair): ?CurrencyRate
	{
		return $this->currencyRateFinder->findByCurrencyPair($currencyPair);
	}
}