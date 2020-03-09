<?php

namespace CurrencyRate\tests\Domain;


use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use PHPUnit\Framework\TestCase;

class CurrencyRateTest extends TestCase
{
	/**
	 * @throws \CurrencyRate\Domain\InvalidCurrencyError
	 */
	public function testEqualObjectsEquality()
	{
		$currencyRate = new CurrencyRate(
			new CurrencyPair(
				Currency::fromString("USD"),
				Currency::fromString("RUB")
			),
			10.50
		);
		$this->assertTrue($currencyRate->equals(
			new CurrencyRate(
				new CurrencyPair(
					Currency::fromString("USD"),
					Currency::fromString("RUB")
				),
				10.50
			)
		));
	}

	/**
	 * @throws \CurrencyRate\Domain\InvalidCurrencyError
	 */
	public function testNotEqualObjectsEquality()
	{
		$currencyRate = new CurrencyRate(
			new CurrencyPair(
				Currency::fromString("USD"),
				Currency::fromString("RUB")
			),
			10.50
		);
		$this->assertFalse($currencyRate->equals(
			new CurrencyRate(
				new CurrencyPair(
					Currency::fromString("RUB"),
					Currency::fromString("USD")
				),
				10.50
			)
		));
	}
}