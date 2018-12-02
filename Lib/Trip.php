<?php
/**
 * The sorted trip class
 */
declare(strict_types=1);

namespace Lib;
use Lib\Cards\BoardingCard;

/**
 * The sorted trip class
 */
class Trip implements \IteratorAggregate
{
	/**
	 * The first location of the trip
	 * @var string
	 */
	private $startNodeSource;

	/**
	 * A map of all the segment nodes
	 * Format: array(
	 * 	"SourceLocation" => $segment
	 * )
	 * @var array()
	 */
	private $parents;

	/**
	 * The trip constructor
	 * @param iterable|null $parents The trip parent map
	 * @param string|null $startNode The start location
	 */
	public function __construct(iterable $parents = null, string $startNode = null)
	{
		$this->parents = $parents == null ? [] : $parents;

		$this->startNodeSource = $startNode === null || $startNode === "" ? "" : $startNode;
		if (!empty($this->parents))
		{
			if (!$this->hasNode($this->startNodeSource))
			{
				throw new \InvalidArgumentException("Start node not present in the trip");
			}
		}
	}

	/**
	 * Returns a new trip iterator
	 * @return Iterator
	 */
	public function getIterator(): \Iterator
	{
		return new TripIterator($this);
	}

	/**
	 * Returns the first node in the trip
	 * @return IBoardingCard
	 */
	public function getStartNode()
	{
		if (!$this->hasNode($this->startNodeSource))
		{
			return null;
		}

		return $this->getNode($this->startNodeSource);
	}

	/**
	 * Returns true of the provided source location exists in this trip
	 * @param string $source The source location
	 * @return bool
	 */
	public function hasNode(string $source): bool
	{
		return array_key_exists($source, $this->parents);
	}

	/**
	 * Returns true if the destination is not the last segment
	 * @param BoardingCard $segment The segment to be verified
	 * @return bool
	 */
	public function isLastNode(BoardingCard $segment): bool
	{
		if ($segment == null)
		{
			throw new \InvalidArgumentException("Empty segment provided");
		}

		return $this->hasNode($segment->getTarget());
	}

	/**
	 * Returns the trip node that start in the provided location
	 * @param string $source The source location of the node 
	 * @return BoardingCard
	 */
	public function getNode(string $source): BoardingCard
	{
		if (!$this->hasNode($source))
		{
			throw new \InvalidArgumentException("There is no trip segment from ".$source);
		}

		return $this->parents[$source];
	}

	/**
	 * Returns the next trip node after the provided segment
	 * @param BoardingCard $segment The segment to be verified
	 * @return BoardingCard
	 */
	public function getNextNode(BoardingCard $segment)
	{
		if ($segment == null)
		{
			throw new \InvalidArgumentException("Empty segment provided");
		}

		if (!$this->hasNode($segment->getTarget()))
		{
			return null;
		}

		return $this->getNode($segment->getTarget());
	}

	/**
	 * Returns the trip summary
	 * @return string
	 */
	public function printSummary(): string
	{
		$formattedTrip = "";
		$tripLeg = 1;
		foreach ($this as $node)
		{
			$formattedTrip .= sprintf('%1$d. %2$s'.PHP_EOL, $tripLeg++, $node->getTripDescription());
		}

		if ($formattedTrip === "")
		{
			return $formattedTrip;
		}

		$formattedTrip .= sprintf('%1$d. %2$s'.PHP_EOL, $tripLeg++, "You have arrived at your final destination.");

		return $formattedTrip;
	}
}
