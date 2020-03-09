<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\CurrencyRateRepositoryInterface;

class CachingCurrencyRateRepository implements CurrencyRateRepositoryInterface
{
	/**
	 * @var CurrencyRateRepositoryInterface
	 */
	private $cache;
	/**
	 * @var CurrencyRateRepositoryInterface
	 */
	private $source;

	/**
	 * @param CurrencyRateRepositoryInterface $cache
	 * @param CurrencyRateRepositoryInterface $source
	 */
	public function __construct(
		CurrencyRateRepositoryInterface $cache,
		CurrencyRateRepositoryInterface $source
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
		$finder = new CachingCurrencyRateFinder($this->cache, $this->source);
		return $finder->findByCurrencyPair($currencyPair);
	}

	/**
	 * @param CurrencyRate $currencyRate
	 */
	public function save(CurrencyRate $currencyRate): void
	{
		$this->cache->save($currencyRate);
		$this->source->save($currencyRate);
	}
}