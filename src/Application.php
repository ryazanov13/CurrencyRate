<?php

namespace CurrencyRate;

use Exception;

class Application
{
	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var Environment
	 */
	private $environment;

	/**
	 * @param Config $config
	 * @param Environment $environment
	 */
	public function __construct(
		Config $config,
		Environment $environment
	) {
		$this->config = $config;
		$this->environment = $environment;
	}

	/**
	 * @return void
	 */
	public function run(): void
	{
		try {
			$arguments = $this->environment->getArguments();
			$factory = new Factory(
				$this->config->createMemoryCurrencyRateList(),
				$this->config->createDataBaseCurrencyRateList(),
				$this->config->createRemoteServiceCurrencyRateList()
			);
			$controller = new CurrencyRateController(
				$factory->createCurrencyRateFinder()
			);
			$result = $controller->run($arguments);
			$this->environment->setOutput($result);
		} catch (Exception $e) {
			$this->environment->setOutput((string)$e);
		}
	}
}