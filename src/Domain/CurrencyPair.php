<?php

namespace CurrencyRate\Domain;

class CurrencyPair
{
	/**
	 * @var Currency
	 */
	private $base;
	/**
	 * @var Currency
	 */
	private $quote;

	/**
	 * @param Currency $base
	 * @param Currency $quote
	 */
	public function __construct(
		Currency $base,
		Currency $quote
	) {
		$this->base = $base;
		$this->quote = $quote;
	}

	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->base->toString()
			. $this->quote->toString();
	}
}