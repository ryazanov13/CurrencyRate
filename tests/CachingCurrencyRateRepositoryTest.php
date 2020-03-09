<?php

namespace CurrencyRate\tests;


use CurrencyRate\CachingCurrencyRateRepository;
use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\InvalidCurrencyError;
use CurrencyRate\FakeCurrencyRateRepository;
use PHPUnit\Framework\TestCase;

class CachingCurrencyRateRepositoryTest extends TestCase
{
	/**
	 * @throws InvalidCurrencyError
	 */
	public function testCurrencyRateSaving()
	{
		$currencyPair = new CurrencyPair(
			Currency::fromString("USD"),
			Currency::fromString("RUB")
		);
		$currencyRate = new CurrencyRate(
			$currencyPair,
			10.50
		);
		$cache = new FakeCurrencyRateRepository([]);
		$source = new FakeCurrencyRateRepository([]);
		$cachingCurrencyRateRepository = new CachingCurrencyRateRepository(
			$cache,
			$source
		);
		$cachingCurrencyRateRepository->save($currencyRate);
		$cachedCurrencyRate = $cache->findByCurrencyPair($currencyPair);
		$inSourceCurrencyRate = $source->findByCurrencyPair($currencyPair);
		$this->assertNotNull($cachedCurrencyRate);
		$this->assertNotNull($inSourceCurrencyRate);
	}
}