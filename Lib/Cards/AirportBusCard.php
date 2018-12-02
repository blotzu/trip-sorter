<?php
/**
 * The airport bus boarding card class
 */
declare(strict_types=1);

namespace Lib\Cards;

/**
 * The airport bus boarding card class
 */
class AirportBusCard extends BoardingCard
{
	use Traits\SeatNumber;

	/**
	 * Returns the trip segment description
	 * @return string
	 */
	public function getTripDescription(): string
	{
		return sprintf('Take the airport bus from %s to %s. %s',
			$this->getSource(),
			$this->getTarget(),
			$this->getSeatDescription());
	}
}

