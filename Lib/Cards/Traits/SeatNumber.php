<?php
/**
 * The gate number trait
 */
declare(strict_types=1);

namespace Lib\Cards\Traits;

/**
 * The gate number trait
 * Adds the ability for a boarding card to have a seat number
 */
trait SeatNumber
{
	/**
	 * The seat number
	 * @var string
	 */
	private $seatNumber = "";

	/**
	 * Returns the seat number
	 * @return string
	 */
	public function getSeatNumber(): string
	{
		return $this->seatNumber;
	}

	/**
	 * Sets the seat number
	 * @param type|string $seatNumber The seat number
	 * @throws InvalidArgumentException if the provided seat number is empty 
	 * @return void
	 */
	public function setSeatNumber(string $seatNumber = ""): void
	{
		if ($seatNumber === "")
		{
			throw new InvalidArgumentException("Invalid seat number");
		}

		$this->seatNumber = trim($seatNumber);
	}

	/**
	 * Returns the seat number description
	 * @return string
	 */
	public function getSeatDescription()
	{
		if (is_null($this->seatNumber) || $this->seatNumber === "")
		{
			return 'No seat assignment.';
		}

		return sprintf('Sit in seat %1$s.',
			$this->seatNumber);
	}
}