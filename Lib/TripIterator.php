<?php
/**
 * The iterator for the Trip class
 */
declare(strict_types=1);

namespace Lib;
use Lib\Cards\BoardingCard;

/**
 * The iterator for the Trip class
 */
class TripIterator implements \Iterator
{
	/**
	 * The current node
	 * @var BoardingCard
	 */
	private $currentNode;

	/**
	 * The trip over which this iterator walks
	 * @var Trip
	 */
	private $trip;

	/**
	 * The iterator constructor
	 * @param Trip $trip 
	 */
    public function __construct(Trip $trip)
    {
    	$this->trip = $trip;
    	$this->currentNode = $trip->getStartNode();
    }

	/**
	 * The current element
	 * @return BoardingCard
	 */
    public function current(): BoardingCard
    {
    	return $this->currentNode;
    }

    /**
     * Moves the iterator to the next positionm
     * Returns false if the iterator has reached the end of the sequence
     * @return bool
     */
    public function next(): bool
    {
    	if ($this->currentNode == null)
    	{
    		return false;
    	}

		$this->currentNode = $this->trip->getNextNode($this->currentNode);
		return true;
    }

    /**
     * Returns the key of the current element in the sequence
     * @return string
     */
    public function key(): string
    {
    	return $this->currentNode->getSource();
    }

    /**
     * Returns true if the current node is valid
     * @return bool
     */
    public function valid(): bool
    {
    	return $this->currentNode != null;
    }

    /**
     * Rewinds the iterator back to the first position
     * @return void
     */
    public function rewind(): void
    {
    	$this->currentNode = $this->trip->getStartNode();
    }    
}
