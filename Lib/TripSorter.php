<?php
/**
 * The trip sorter class
 */
declare(strict_types=1);

namespace Lib;
use Lib\Cards\BoardingCard;

/**
 * The trip sorter class
 * Used to create sorter Trip objects from unsorted segment lists
 */
class TripSorter
{
	/**
	 * Sorts the input segment list and returns a valid Trip
	 * Sample input:
	 * [
	 * 		new AirportBusCard($source = "Madrid", $target = "Malaga Airport")
	 * 		new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45A"),
	 * ]
	 * Sample output: A instance of the Trip class containing:
	 * [
	 * 		new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45A"),
	 * 		new AirportBusCard($source = "Madrid", $target = "Malaga Airport")
	 * ]
	 * @param iterable|null $trip The unsorted trip segment list
	 * @return Trip
	 */
	public function sort(iterable $trip = null): Trip
	{
		if ($trip == null || empty($trip))
		{
			return new Trip();
		}

		$parents = array();
		$targets = array();
		$first = array();

		foreach ($trip as $key => $card)
		{
			if ($card == null)
			{
				throw new \InvalidArgumentException("Null boarding card found at index ". $key);
			}
			if (!($card instanceof Cards\BoardingCard))
			{
				throw new \InvalidArgumentException("Invalid boarding card type ". gettype($card));
			}

			if (array_key_exists($card->getSource(), $parents))
			{
				throw new \InvalidArgumentException("Found more than one boarding card departing from ". $card->getSource());
			}

			$parents[$card->getSource()] = $card;
			$first[$card->getSource()] = $card;
			$targets[$card->getTarget()] = $card;

			if (array_key_exists($card->getSource(), $targets))
			{
				unset($first[$card->getSource()]);
			}
			if (array_key_exists($card->getTarget(), $first))
			{
				unset($first[$card->getTarget()]);
			}
		}

		if (count($first) > 1)
		{
			throw new \InvalidArgumentException("Found more than one starting point: ". implode(',', array_map(function($item) { return $item->getSource(); }, $first)));
		}

		if (empty($first))
		{
			throw new \InvalidArgumentException("Could not find starting station");
		}

		$firstNode = reset($first);
		$currentNode = $parents[$firstNode->getSource()];

		return new Trip($parents, $firstNode->getSource());
	}
}
