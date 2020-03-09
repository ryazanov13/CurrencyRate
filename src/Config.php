<?php

namespace CurrencyRate;

use CurrencyRate\Domain\Currency;
use CurrencyRate\Domain\CurrencyPair;
use CurrencyRate\Domain\CurrencyRate;
use CurrencyRate\Domain\InvalidCurrencyError;

class Config
{
	/**
	 * @var string[][]
	 */
	private $memoryCurrencyRateConfigList;
	/**
	 * @var string[][]
	 */
	private $dataBaseCurrencyRateConfigList;
	/**
	 * @var string[][]
	 */
	private $remoteServiceCurrencyRateConfigList;

	/**
	 * @param string[][] $memoryCurrencyRateConfigList
	 * @param string[][] $dataBaseCurrencyRateConfigList
	 * @param string[][] $remoteServiceCurrencyRateConfigList
	 */
	public function __construct(
		array $memoryCurrencyRateConfigList,
		array $dataBaseCurrencyRateConfigList,
		array $remoteServiceCurrencyRateConfigList
	) {

		$this->memoryCurrencyRateConfigList = $memoryCurrencyRateConfigList;
		$this->dataBaseCurrencyRateConfigList = $dataBaseCurrencyRateConfigList;
		$this->remoteServiceCurrencyRateConfigList = $remoteServiceCurrencyRateConfigList;
	}

	/**
	 * @param string[][][] $array
	 * @return static
	 */
	static public function fromArray(array $array): self
	{
		return new static(
			$array['memory_currency_rate_list'],
			$array['data_base_currency_rate_list'],
			$array['remote_service_currency_rate_list']
		);
	}

	/**
	 * @return CurrencyRate[]
	 * @throws InvalidCurrencyError
	 */
	public function createMemoryCurrencyRateList(): array
	{
		return $this->createCurrencyRateList(
			$this->memoryCurrencyRateConfigList
		);
	}

	/**
	 * @return CurrencyRate[]
	 * @throws InvalidCurrencyError
	 */
	public function createDataBaseCurrencyRateList(): array
	{
		return $this->createCurrencyRateList(
			$this->dataBaseCurrencyRateConfigList
		);
	}

	/**
	 * @return CurrencyRate[]
	 * @throws InvalidCurrencyError
	 */
	public function createRemoteServiceCurrencyRateList(): array
	{
		return $this->createCurrencyRateList(
			$this->remoteServiceCurrencyRateConfigList
		);
	}

	/**
	 * @param string[][] $currencyRateConfigList
	 * @return CurrencyRate[]
	 * @throws InvalidCurrencyError
	 */
	private function createCurrencyRateList(array $currencyRateConfigList): array
	{
		$currencyRateList = [];
		foreach ($currencyRateConfigList as $currencyRateConfig) {
			$currencyPair = new CurrencyPair(
				Currency::fromString($currencyRateConfig[0]),
				Currency::fromString($currencyRateConfig[1])
			);
			$currencyRateList[$currencyPair->toString()] = new CurrencyRate(
				$currencyPair,
				(float)$currencyRateConfig[2]
			);
		}
		return $currencyRateList;
	}
}