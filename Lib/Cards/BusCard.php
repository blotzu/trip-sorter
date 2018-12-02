<?php
/**
 * The bus boarding card class
 */
declare(strict_types=1);

namespace Lib\Cards;

/**
 * The bus boarding card class
 */
class BusCard extends BoardingCard
{
	use Traits\SeatNumber;
	use Traits\VehicleNumber;

	/**
	 * The bus boarding card constructor
	 * @param type|string $source The source location
	 * @param type|string $target The destination location
	 * @param type|string $vehicleNumber The vehicle number
	 */
	public function __construct($source = "", $target = "", $vehicleNumber = "")
	{
		parent::__construct($source, $target);

		if ($vehicleNumber == "")
		{
			throw new \InvalidArgumentException("Invalid vehicle number ". $vehicleNumber);
		}

		$this->setVehicleNumber($vehicleNumber);
	}

	/**
	 * Returns the trip segment description
	 * @return string
	 */
	public function getTripDescription(): string
	{
		return sprintf('Take bus %1$s from %2$s to %3$s. %4$s',
			$this->getVehicleNumber(),
			$this->getSource(),
			$this->getTarget(),
			$this->getSeatDescription());
	}
}