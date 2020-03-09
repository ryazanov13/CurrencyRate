<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyRateFinderInterface;

interface FactoryInterface
{
	/**
	 * @return CurrencyRateFinderInterface
	 */
	public function createCurrencyRateFinder(): CurrencyRateFinderInterface;
}