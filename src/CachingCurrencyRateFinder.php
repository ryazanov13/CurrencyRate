<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\CurrencyRateFinderInterface;
use CurrencyRate\Domain\CurrencyRateRepositoryInterface;

class CachingCurrencyRateFinder implements CurrencyRateFinderInterface
{
	/**
	 * @var CurrencyRateRepositoryInterface
	 */
	private $cache;
	/**
	 * @var CurrencyRateFinderInterface
	 */
	private $source;

	/**
	 * @param CurrencyRateRepositoryInterface $cache
	 * @param CurrencyRateFinderInterface $source
	 */
	public function __construct(
		CurrencyRateRepositoryInterface $cache,
		CurrencyRateFinderInterface $source
	) {
		$this->cache = $cache;
		$this->source = $source;
	}

	/**
	 * @param CurrencyPair $currencyPair
	 * @return CurrencyRate|null
	 */
	public function findByCurrencyPair(CurrencyPair $currencyPair): ?CurrencyRate
	{
		$currencyRate = $this->cache->findByCurrencyPair($currencyPair);
		if (!is_null($currencyRate)) {
			return $currencyRate;
		}
		$currencyRate = $this->source->findByCurrencyPair($currencyPair);
		if (!is_null($currencyRate)) {
			$this->cache->save($currencyRate);
			return $currencyRate;
		}
		return null;
	}
}