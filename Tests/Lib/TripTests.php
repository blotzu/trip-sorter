<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lib\Trip;
use Lib\Cards\TrainCard;
use Lib\Cards\AirportBusCard;

class TripTests extends TestCase  
{
	/**
	 * Tests the trip properties for an empty trip
	 */
    public function test_AllProperties_EmptyTrip(): void
    {
    	$trip = new Trip();
		$this->assertEquals([], iterator_to_array($trip, $use_keys = false), "Incorrect result order");
		$this->assertEquals("", $trip->printSummary(), "Incorrect trip summary");
		$this->assertEquals(null, $trip->getStartNode(), "Incorrect start node");
		$this->assertEquals(false, $trip->hasNode(""), "Incorrect hasNode result");
    }

	/**
	 * Tests the trip properties for a non-emtyp trip
	 */
    public function test_AllProperties_SimpleTrip(): void
    {
    	$nodes = [
    		"Barcelona" => new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45A"),
    		"Madrid" => new AirportBusCard($source = "Madrid", $target = "Malaga Airport"),
    	];
    	$firstNode = $nodes["Barcelona"];
    	$lastNode = $nodes["Madrid"];
    	$trip = new Trip($parents = $nodes, $startNode = "Barcelona");

		$expectedSummary = "1. Take train 45A from Barcelona to Madrid. No seat assignment." . PHP_EOL
. "2. Take the airport bus from Madrid to Malaga Airport. No seat assignment." . PHP_EOL
. "3. You have arrived at your final destination." . PHP_EOL;

		$this->assertEquals(array_values($parents), iterator_to_array($trip, $use_keys = false), "Incorrect result order");
		$this->assertEquals($expectedSummary, $trip->printSummary(), "Incorrect trip summary");
		$this->assertEquals($firstNode, $trip->getStartNode(), "Incorrect start node");

		$this->assertEquals(true, $trip->hasNode("Barcelona"), "Incorrect hasNode result");
		$this->assertEquals(true, $trip->isLastNode($firstNode), "Incorrect hasNode result");
		$this->assertEquals($lastNode, $trip->getNextNode($firstNode), "Incorrect isLastNode result");

		$this->assertEquals(false, $trip->isLastNode($lastNode), "Incorrect isLastNode result");
    }

	/**
	 * Tests the trip properties for a non-emtyp trip
	 */
    public function test_AllProperties_ComplexTrip(): void
    {
    	$nodes = [
    		"Madrid" => new AirportBusCard($source = "Madrid", $target = "Madrid Airport"),
    		"Madrid Airport" => new AirportBusCard($source = "Madrid Airport", $target = "Berlin Airport", $vehicleNumber = "TG56", $gateNumber = "14", $seatNumber = "27B"),
    		"Berlin Airport" => new AirportBusCard($source = "Berlin Airport", $target = "Berlin"),
    		"Berlin" => new TrainCard($source = "Berlin", $target = "Stockholm", $vehicleNumber = "A54", $seatNumber = "B4"),
    		"Stockholm" => new TrainCard($source = "Stockholm", $target = "Moscow", $vehicleNumber = "KT1", $seatNumber = "A12"),
    	];
    	$firstNode = $nodes["Madrid"];
    	$lastNode = $nodes["Stockholm"];
    	$trip = new Trip($parents = $nodes, $startNode = "Madrid");

		$expectedSummary = "1. Take the airport bus from Madrid to Madrid Airport. No seat assignment." . PHP_EOL
. "2. Take the airport bus from Madrid Airport to Berlin Airport. No seat assignment." . PHP_EOL
. "3. Take the airport bus from Berlin Airport to Berlin. No seat assignment." . PHP_EOL
. "4. Take train A54 from Berlin to Stockholm. No seat assignment." . PHP_EOL
. "5. Take train KT1 from Stockholm to Moscow. No seat assignment." . PHP_EOL
. "6. You have arrived at your final destination." . PHP_EOL;

		$this->assertEquals(array_values($parents), iterator_to_array($trip, $use_keys = false), "Incorrect result order");
		$this->assertEquals($expectedSummary, $trip->printSummary(), "Incorrect trip summary");
		$this->assertEquals($firstNode, $trip->getStartNode(), "Incorrect start node");

		$this->assertEquals(true, $trip->hasNode("Madrid"), "Incorrect hasNode result");
		$this->assertEquals(true, $trip->isLastNode($firstNode), "Incorrect hasNode result");
		$this->assertEquals(false, $trip->isLastNode($lastNode), "Incorrect isLastNode result");
    }
}
