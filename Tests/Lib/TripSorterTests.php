<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lib\TripSorter;
use Lib\Cards\TrainCard;
use Lib\Cards\BusCard;
use Lib\Cards\AirportBusCard;

class TripSorterTests extends TestCase  
{
	/**
	 * Tests TripSorter::Sort method
	 * The input list is already sorted
	 */
    public function test_Valid_AlreadySorted(): void
    {
    	$args = array();
		$train = new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45A");
		$train->SetSeatNumber("45B");
		$args []= $train;

		$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "45B");
		$bus->SetSeatNumber("45B");
		$args []= $bus;

    	$expectedResults = $args;

		$sorter = new TripSorter();
		$results = $sorter->sort($args);

		$expectedSummary = "1. Take train 45A from Barcelona to Madrid. Sit in seat 45B." . PHP_EOL
			. "2. Take bus 45B from Madrid to Malaga. Sit in seat 45B." . PHP_EOL
			. "3. You have arrived at your final destination." . PHP_EOL;
		$this->assertEquals($expectedResults, iterator_to_array($results, $use_keys = false), "Incorrect result order");
		$this->assertEquals($expectedSummary, $results->printSummary(), "Incorrect trip summary");
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is not sorter
	 */
    public function test_Valid_Unsorted_Simple(): void
    {
    	$args = array();

		$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "45A");
		$bus->SetSeatNumber("45B");
		$args []= $bus;

		$train = new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45A");
		$train->SetSeatNumber("45B");
		$args []= $train;

    	$expectedResults = array($args[1], $args[0]);

		$sorter = new TripSorter();
		$results = $sorter->sort($args);

		$expectedSummary = "1. Take train 45A from Barcelona to Madrid. Sit in seat 45B." . PHP_EOL
. "2. Take bus 45A from Madrid to Malaga. Sit in seat 45B." . PHP_EOL
. "3. You have arrived at your final destination." . PHP_EOL;

		$this->assertEquals($expectedResults, iterator_to_array($results, $use_keys = false), "Incorrect result order");
		$this->assertEquals($expectedSummary, $results->printSummary(), "Incorrect trip summary");
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is not sorter
	 */
    public function test_Valid_Unsorted_Complex(): void
    {
    	$args = array();

		$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "45A");
		$bus->SetSeatNumber("45B");
		$args []= $bus;

		$train = new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45B");
		$train->SetSeatNumber("123");
		$args []= $train;

		$train = new TrainCard($source = "Moscow", $target = "Vladivostok", $vehicleNumber = "T1");
		$train->SetSeatNumber("A67");
		$args []= $train;

		$train = new TrainCard($source = "Malaga", $target = "Moscow", $vehicleNumber = "45C");
		$train->SetSeatNumber("4");
		$args []= $train;

    	$expectedResults = array($args[1], $args[0], $args[3], $args[2]);

		$sorter = new TripSorter();
		$results = $sorter->sort($args);

		$expectedSummary = "1. Take train 45B from Barcelona to Madrid. Sit in seat 123." . PHP_EOL
. "2. Take bus 45A from Madrid to Malaga. Sit in seat 45B." . PHP_EOL
. "3. Take train 45C from Malaga to Moscow. Sit in seat 4." . PHP_EOL
. "4. Take train T1 from Moscow to Vladivostok. Sit in seat A67." . PHP_EOL
. "5. You have arrived at your final destination." . PHP_EOL;

		$this->assertEquals($expectedResults, iterator_to_array($results, $use_keys = false), "Incorrect result order");
		$this->assertEquals($expectedSummary, $results->printSummary(), "Incorrect trip summary");
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is invalid - not a continuous trip
	 */
    public function test_Invalid_MissingLink(): void
    {
    	$args = array();

		$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "45A");
		$bus->SetSeatNumber("45B");
		$args []= $bus;

		$train = new TrainCard($source = "Paris", $target = "Berlin", $vehicleNumber = "45A");
		$train->SetSeatNumber("45B");
		$args []= $train;

		$sorter = new TripSorter();

        $this->expectException(\InvalidArgumentException::class);

		$results = $sorter->sort($args);
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is invalid - not a continuous trip
	 */
    public function test_Invalid_MultipleStartingPoints(): void
    {
    	$args = array();

		$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "45A");
		$bus->SetSeatNumber("45B");
		$args []= $bus;

		$train = new TrainCard($source = "Barcelona", $target = "Malaga", $vehicleNumber = "45A");
		$train->SetSeatNumber("45B");
		$args []= $train;

		$sorter = new TripSorter();

        $this->expectException(\InvalidArgumentException::class);

		$results = $sorter->sort($args);
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is invalid - not a continuous trip
	 */
    public function test_Invalid_MultipleDestinationsFromOneNode(): void
    {
    	$args = array();

		$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "45A");
		$bus->SetSeatNumber("45B");
		$args []= $bus;

		$train = new TrainCard($source = "Madrid", $target = "Berlin", $vehicleNumber = "45A");
		$train->SetSeatNumber("45B");
		$args []= $train;

		$sorter = new TripSorter();

        $this->expectException(\InvalidArgumentException::class);

		$results = $sorter->sort($args);
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is empty
	 */
    public function test_Valid_EmptyTrip(): void
    {
		$sorter = new TripSorter();
		$results = $sorter->sort([]);

		$this->assertEquals([], iterator_to_array($results, $use_keys = false), "Incorrect results");
		$this->assertEquals("", $results->printSummary(), "Incorrect trip summary");
    }

	/**
	 * Tests TripSorter::Sort method
	 * The input list is large
	 */
    public function test_Valid_LargeInput(): void
    {
    	$args = [];
    	$numberOfCards = 1000;
    	for ($i = 1; $i < $numberOfCards; $i++)
    	{
			$train = new AirportBusCard($source = (string)($numberOfCards - $i - 1), $target = (string)($numberOfCards - $i));
			$args []= $train;
    	}

    	$expectedResults = array_reverse($args);

		$sorter = new TripSorter();
		$results = $sorter->sort($args);

		$i = 0;
		foreach ($results as $card)
    	{
    		$this->assertEquals((string)$i, $card->getSource());
    		$i++;
		}
    }
}