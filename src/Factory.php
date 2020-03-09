<?php

namespace CurrencyRate;

use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\CurrencyRateFinderInterface;

class Factory implements FactoryInterface
{
	/**
	 * @var CurrencyRate[]
	 */
	private $memoryCurrencyRateList;
	/**
	 * @var CurrencyRate[]
	 */
	private $dataBaseCurrencyRateList;
	/**
	 * @var CurrencyRate[]
	 */
	private $remoteServiceCurrencyRateList;

	/**
	 * @param CurrencyRate[] $memoryCurrencyRateList
	 * @param CurrencyRate[] $dataBaseCurrencyRateList
	 * @param CurrencyRate[] $remoteServiceCurrencyRateList
	 */
	public function __construct(
		array $memoryCurrencyRateList,
		array $dataBaseCurrencyRateList,
		array $remoteServiceCurrencyRateList
	) {
		$this->memoryCurrencyRateList = $memoryCurrencyRateList;
		$this->dataBaseCurrencyRateList = $dataBaseCurrencyRateList;
		$this->remoteServiceCurrencyRateList = $remoteServiceCurrencyRateList;
	}

	/**
	 * @return CachingCurrencyRateFinder
	 */
	public function createCurrencyRateFinder(): CurrencyRateFinderInterface
	{
		return new CachingCurrencyRateFinder(
			new CachingCurrencyRateRepository(
				new MemoryCurrencyRateRepository(
					new FakeCurrencyRateRepository($this->memoryCurrencyRateList)
				),
				new DataBaseCurrencyRateRepository(
					new FakeCurrencyRateRepository($this->dataBaseCurrencyRateList)
				)
			),
			new RemoteServiceCurrencyRateFinder(
				new FakeCurrencyRateRepository($this->remoteServiceCurrencyRateList)
			)
		);
	}
}