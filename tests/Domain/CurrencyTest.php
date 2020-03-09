<?php

namespace CurrencyRate\Tests\Domain;

use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\InvalidCurrencyError;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
	/**
	 * @throws InvalidCurrencyError
	 */
	public function testCreationFromValidString()
	{
		$value = 'RUB';
		$currency = Currency::fromString($value);
		$this->assertEquals($value, $currency->toString());
	}

	/**
	 * @expectedException \CurrencyRate\Domain\InvalidCurrencyError
	 */
	public function testCreationFromInvalidString()
	{
		$value = 'RU';
		Currency::fromString($value);
	}
}