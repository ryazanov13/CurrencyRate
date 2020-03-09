<?php

namespace CurrencyRate\Tests;


use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\InvalidCurrencyError;
use CurrencyRate\FakeCurrencyRateRepository;
use PHPUnit\Framework\TestCase;

class FakeCurrencyRateRepositoryTest extends TestCase
{
	/**
	 * @throws InvalidCurrencyError
	 */
	public function testExistingCurrencyRateFinding()
	{
		$currencyRate = new CurrencyRate(
			new CurrencyPair(
				Currency::fromString("USD"),
				Currency::fromString("RUB")
			),
			10.50
		);
		$currencyRateList = [
			$currencyRate->getPair()->toString() => $currencyRate
		];
		$fakeCurrencyRateRepository = new FakeCurrencyRateRepository($currencyRateList);
		$foundCurrencyRate = $fakeCurrencyRateRepository->findByCurrencyPair(
			$currencyRate->getPair()
		);
		$this->assertNotNull($foundCurrencyRate);
	}

	/**
	 * @throws InvalidCurrencyError
	 */
	public function testNotExistingCurrencyRateFinding()
	{
		$fakeCurrencyRateRepository = new FakeCurrencyRateRepository([]);
		$currencyPair = new CurrencyPair(
			Currency::fromString("USD"),
			Currency::fromString("RUB")
		);
		$foundCurrencyRate = $fakeCurrencyRateRepository->findByCurrencyPair($currencyPair);
		$this->assertNull($foundCurrencyRate);
	}

	/**
	 * @throws InvalidCurrencyError
	 */
	public function testCurrencyRateSaving()
	{
		$currencyRate = new CurrencyRate(
			new CurrencyPair(
				Currency::fromString("USD"),
				Currency::fromString("RUB")
			),
			10.50
		);
		$fakeCurrencyRateRepository = new FakeCurrencyRateRepository([]);
		$fakeCurrencyRateRepository->save($currencyRate);
		$foundCurrencyRate = $fakeCurrencyRateRepository->findByCurrencyPair(
			$currencyRate->getPair()
		);
		$this->assertTrue($foundCurrencyRate->equals($currencyRate));
	}
}