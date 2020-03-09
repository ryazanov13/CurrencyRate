<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\CurrencyRateRepositoryInterface;

class DataBaseCurrencyRateRepository implements CurrencyRateRepositoryInterface
{
	/**
	 * @var CurrencyRateRepositoryInterface
	 */
	private $currencyRateRepository;

	/**
	 * @param CurrencyRateRepositoryInterface $currencyRateRepository
	 */
	public function __construct(CurrencyRateRepositoryInterface $currencyRateRepository)
	{
		$this->currencyRateRepository = $currencyRateRepository;
	}

	/**
	 * @param CurrencyPair $currencyPair
	 * @return CurrencyRate|null
	 */
	public function findByCurrencyPair(CurrencyPair $currencyPair): ?CurrencyRate
	{
		return $this->currencyRateRepository->findByCurrencyPair($currencyPair);
	}

	/**
	 * @param CurrencyRate $currencyRate
	 */
	public function save(CurrencyRate $currencyRate): void
	{
		$this->currencyRateRepository->save($currencyRate);
	}
}