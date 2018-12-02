<?php
/**
 * The plane boarding card class
 */
declare(strict_types=1);

namespace Lib\Cards;

/**
 * The plane boarding card class
 */
class PlaneCard extends BoardingCard
{
	use Traits\SeatNumber;
	use Traits\VehicleNumber;
	use Traits\GateNumber;
	use Traits\BaggageCounter;

	/**
	 * The constructor for the train card
	 * @param type|string $source The source location
	 * @param type|string $target The destination locationm
	 * @param type|string $vehicleNumber The vehicle number
	 * @param type|string $gateNumber The airport gate number
	 * @param type|string $seatNumber The airplane seat number
	 */
	public function __construct(string $source = "", string $target = "", string $vehicleNumber = "", string $gateNumber = "", string $seatNumber = "")
	{
		parent::__construct($source, $target);

		$vehicleNumber = trim($vehicleNumber);
		if ($vehicleNumber == "")
		{
			throw new \InvalidArgumentException("Invalid vehicle number ". $vehicleNumber);
		}
		$this->setVehicleNumber($vehicleNumber);

		$gateNumber = trim($gateNumber);
		if ($gateNumber == "")
		{
			throw new \InvalidArgumentException("Invalid gate number ". $gateNumber);
		}
		$this->setGateNumber($gateNumber);

		$seatNumber = trim($seatNumber);
		if ($seatNumber == "")
		{
			throw new \InvalidArgumentException("Invalid seat number ". $seatNumber);
		}
		$this->setSeatNumber($seatNumber);
	}

	/**
	 * Returns the trip segment description
	 * @return string
	 */
	public function getTripDescription(): string
	{
		return sprintf('From %1$s, take flight %2$s to %3$s. Gate %4$s, seat %5$s.'."\n".'%6$s',
			$this->getSource(),
			$this->getVehicleNumber(),
			$this->getTarget(),
			$this->getGateNumber(),
			$this->getSeatNumber(),
			$this->getBaggageCounterDescription());
	}
}

