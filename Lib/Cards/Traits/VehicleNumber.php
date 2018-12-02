<?php
/**
 * The gate number trait
 */
declare(strict_types=1);

namespace Lib\Cards\Traits;

/**
 * The gate number trait
 * Adds the ability for a boarding card to have a vehicle number
 */
trait VehicleNumber
{
	/**
	 * The vehicle number
	 * @var string
	 */
	private $vehicleNumber;

	/**
	 * Returns the vehicle number
	 * @return string
	 */
	public function getVehicleNumber(): string
	{	
		return $this->vehicleNumber;
	}

	/**
	 * Sets the vehicle number
	 * @param type|string $vehicleNumber The vehicle number
	 * @return void
	 */
	public function setVehicleNumber($vehicleNumber = ""): void
	{
		$this->vehicleNumber = $vehicleNumber;
	}
}
