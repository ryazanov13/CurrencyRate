<?php

namespace CurrencyRate\Domain;

class Currency
{
	/**
	 * @var string
	 */
	private $value;

	/**
	 * @param string $value
	 */
	private function __construct(string $value)
	{
		$this->value = $value;
	}

	/**
	 * @param string $string
	 * @return static
	 * @throws InvalidCurrencyError
	 */
	static public function fromString(string $string): self
	{
		if (!preg_match("|^[A-Z]{3}$|", $string)) {
			throw new InvalidCurrencyError();
		}
		return new static($string);
	}

	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->value;
	}
}