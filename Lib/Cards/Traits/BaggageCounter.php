<?php
/**
 * The baggage drop counter trait
 */
declare(strict_types=1);

namespace Lib\Cards\Traits;

/**
 * The baggage drop counter trait
 * Adds the ability for a boarding card to have a baggage drop counter number
 */
trait BaggageCounter
{
	/**
	 * The baggage drop counter number
	 * @var string
	 */
	private $baggageCounter = "";

	/**
	 * Returns the baggage drop counter number
	 * @return string
	 */
	public function getBaggageCounterNumber(): string
	{
		return $this->baggageCounter;
	}

	/**
	 * Sets the baggage drop counter number
	 * @param type|string $baggageCounter The baggage drop counter number
	 * @return void
	 */
	public function setBaggageCounterNumber(string $baggageCounter = ""): void
	{
		$this->baggageCounter = trim($baggageCounter);
	}

	/**
	 * Returns the baggage drop counter number description
	 * @return string
	 */
	public function getBaggageCounterDescription()
	{
		if ($this->baggageCounter === "")
		{
			return 'Baggage will we automatically transferred from your last leg.';
		}

		return sprintf('Baggage drop at ticket counter %1$s.',
			$this->baggageCounter);
	}
}
