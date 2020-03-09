<?php

namespace CurrencyRate\Domain;

interface CurrencyRateSaverInterface
{
	/**
	 * @param CurrencyRate $currencyRate
	 */
	public function save(CurrencyRate $currencyRate): void;
}