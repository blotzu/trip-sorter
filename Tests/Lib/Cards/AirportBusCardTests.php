<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lib\Cards\AirportBusCard;

/**
 * The AirportBusCard unit test class
 */
class AirportBusCardTests extends TestCase  
{
	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_AllProperties(): void
    {
    	$card = new AirportBusCard($source = "Source", $target = "Target");
    	$card->setSeatNumber("123");

		$this->assertEquals("Source", $card->getSource(), "Incorrect source location");
		$this->assertEquals("Target", $card->getTarget(), "Incorrect target location");
		$this->assertEquals("123", $card->getSeatNumber(), "Incorrect seat number");
    }

	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_GetTripDescription_AllProperties(): void
    {
    	$card = new AirportBusCard($source = "Source", $target = "Target");
    	$card->setSeatNumber("123");

		$this->assertEquals("Take the airport bus from Source to Target. Sit in seat 123.", $card->getTripDescription(), "Incorrect trip description");
    }

	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_GetTripDescription_NoSeatNumber(): void
    {
    	$card = new AirportBusCard($source = "Source", $target = "Target");

		$this->assertEquals("Take the airport bus from Source to Target. No seat assignment.", $card->getTripDescription(), "Incorrect trip description");
    }
}