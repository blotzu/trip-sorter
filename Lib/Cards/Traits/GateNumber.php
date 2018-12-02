<?php
/**
 * The gate number trait
 */
declare(strict_types=1);

namespace Lib\Cards\Traits;

/**
 * The gate number trait
 * Adds the ability for a boarding card to have a gate number
 */
trait GateNumber
{
	/**
	 * The gate number
	 * @var string
	 */
	private $gateNumber = "";

	/**
	 * Returns the gate number
	 * @return string
	 */
	public function getGateNumber(): string
	{
		return $this->gateNumber;
	}

	/**
	 * Sets the gate number
	 * @param type|string $gateNumber The gate number
	 * @return void
	 */
	public function setGateNumber(string $gateNumber = ""): void
	{
		$this->gateNumber = $gateNumber;
	}
}
