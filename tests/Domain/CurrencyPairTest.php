<?php

namespace CurrencyRate\Tests\Domain;


use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use PHPUnit\Framework\TestCase;

class CurrencyPairTest extends TestCase
{
	/**
	 * @throws \CurrencyRate\Domain\InvalidCurrencyError
	 */
	public function testCastToString()
	{
		$base = Currency::fromString("USD");
		$quote = Currency::fromString("RUB");
		$currencyPair = new CurrencyPair($base, $quote);
		$this->assertEquals(
			"USDRUB",
			$currencyPair->toString()
		);
	}
}