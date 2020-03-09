<?php

namespace CurrencyRate\Domain;

interface CurrencyRateFinderInterface
{
	/**
	 * @param CurrencyPair $currencyPair
	 * @return CurrencyRate|null
	 */
	public function findByCurrencyPair(CurrencyPair $currencyPair): ?CurrencyRate;
}