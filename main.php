<?php

include('vendor/autoload.php');

use CurrencyRate\Application;
use CurrencyRate\Config;
use CurrencyRate\Environment;

$test = [
	['USD', 'RUB', 66.07],
	['EUR', 'RUB', 73.73],
	['GBP', 'RUB', 84.50],
];
$configArray = [
	'memory_currency_rate_list' => array_slice($test, 2),
	'data_base_currency_rate_list' => array_slice($test, 1),
	'remote_service_currency_rate_list' => $test,
];
$config = Config::fromArray($configArray);
$environment = new Environment(
	$argv,
	''
);
$application = new Application(
	$config,
	$environment
);
$application->run();
echo $environment->getOutput();