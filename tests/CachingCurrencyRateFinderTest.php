<?php

namespace CurrencyRate\tests;


use CurrencyRate\CachingCurrencyRateFinder;
use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\InvalidCurrencyError;
use CurrencyRate\FakeCurrencyRateRepository;
use PHPUnit\Framework\TestCase;

class CachingCurrencyRateFinderTest extends TestCase
{
	/**
	 * @throws InvalidCurrencyError
	 */
	public function testNotCachedExistingCurrencyRateFinding()
	{
		$currencyPair = new CurrencyPair(
			Currency::fromString("USD"),
			Currency::fromString("RUB")
		);
		$sourceCurrencyRate = new CurrencyRate(
			$currencyPair,
			10.50
		);
		$cache = new FakeCurrencyRateRepository([]);
		$source = new FakeCurrencyRateRepository([
			$sourceCurrencyRate->getPair()->toString() => $sourceCurrencyRate
		]);
		$cachingCurrencyRateFinder = new CachingCurrencyRateFinder(
			$cache,
			$source
		);
		$foundCurrencyRate = $cachingCurrencyRateFinder->findByCurrencyPair(
			$currencyPair
		);
		$cachedCurrencyRate = $cache->findByCurrencyPair($currencyPair);
		$this->assertNotNull($foundCurrencyRate);
		$this->assertNotNull($cachedCurrencyRate);
	}

	/**
	 * @throws InvalidCurrencyError
	 */
	public function testCachedNotExistingCurrencyRateFinding()
	{
		$currencyPair = new CurrencyPair(
			Currency::fromString("USD"),
			Currency::fromString("RUB")
		);
		$cacheCurrencyRate = new CurrencyRate(
			$currencyPair,
			10.50
		);
		$cache = new FakeCurrencyRateRepository([
			$cacheCurrencyRate->getPair()->toString() => $cacheCurrencyRate
		]);
		$source = new FakeCurrencyRateRepository([
		]);
		$cachingCurrencyRateFinder = new CachingCurrencyRateFinder(
			$cache,
			$source
		);
		$foundCurrencyRate = $cachingCurrencyRateFinder->findByCurrencyPair(
			$currencyPair
		);
		$inSourceCurrencyRate = $source->findByCurrencyPair($currencyPair);
		$this->assertNotNull($foundCurrencyRate);
		$this->assertNull($inSourceCurrencyRate);
	}
}