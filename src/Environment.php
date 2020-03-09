<?php

namespace CurrencyRate;

class Environment
{
	/**
	 * @var string[]
	 */
	private $arguments;
	/**
	 * @var string
	 */
	private $output;

	/**
	 * @param string[] $arguments
	 * @param string $output
	 */
	public function __construct(
		array $arguments,
		string $output
	) {
		$this->arguments = $arguments;
		$this->output = $output;
	}

	/**
	 * @return string[]
	 */
	public function getArguments(): array
	{
		return $this->arguments;
	}

	/**
	 * @return string
	 */
	public function getOutput(): string
	{
		return $this->output;
	}

	/**
	 * @param string $output
	 */
	public function setOutput(string $output): void
	{
		$this->output = $output;
	}
}