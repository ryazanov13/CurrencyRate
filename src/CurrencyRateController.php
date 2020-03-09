<?php

namespace CurrencyRate;

use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRateFinderInterface;
use CurrencyRate\Domain\InvalidCurrencyError;

class CurrencyRateController
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
	 * @param array $arguments
	 * @return string
	 */
	public function run(array $arguments): string
	{
		if (count($arguments) < 3) {
			return "enter two currencies";
		}
		try {
			$baseCurrency = Currency::fromString($arguments[1]);
		} catch (InvalidCurrencyError $e) {
			return "invalid first currency";
		}
		try {
			$quoteCurrency = Currency::fromString($arguments[2]);
		} catch (InvalidCurrencyError $e) {
			return "invalid second currency";
		}
		$currencyPair = new CurrencyPair($baseCurrency, $quoteCurrency);
		$currencyRate = $this->currencyRateFinder->findByCurrencyPair($currencyPair);
		if (is_null($currencyRate)) {
			return "currency rate not found";
		}
		return $currencyRate->getAsk();
	}
}