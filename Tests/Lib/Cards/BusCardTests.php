<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lib\Cards\BusCard;

/**
 * The BusCard unit test class
 */
class BusCardTests extends TestCase  
{
	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_AllProperties(): void
    {
    	$card = new BusCard($source = "Source", $target = "Target", $vehicleNumber = "ABC");
    	$card->setSeatNumber("123");

		$this->assertEquals("Source", $card->getSource(), "Incorrect source location");
		$this->assertEquals("Target", $card->getTarget(), "Incorrect target location");
		$this->assertEquals("ABC", $card->getVehicleNumber(), "Incorrect vehicle number");
		$this->assertEquals("123", $card->getSeatNumber(), "Incorrect seat number");
    }

	/**
	 * Tests the card contructor arguments
	 */
    public function test_Contructor_VehicleNumber_Missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);

    	new BusCard($source = "Source", $target = "Target");
    }

	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_Constructor_VehicleNumber_EmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);

    	new BusCard($source = "Source", $target = "Target", $vehicleNumber = "");
    }

	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_GetTripDescription_AllProperties(): void
    {
    	$card = new BusCard($source = "Source", $target = "Target", $vehicleNumber = "AB1");
    	$card->setSeatNumber("123");

		$this->assertEquals("Take bus AB1 from Source to Target. Sit in seat 123.", $card->getTripDescription(), "Incorrect trip description");
    }

	/**
	 * Tests the card properties accessors return the correct values
	 */
    public function test_GetTripDescription_NoSeatNumber(): void
    {
    	$card = new BusCard($source = "Source", $target = "Target", $vehicleNumber = "AB1");

		$this->assertEquals("Take bus AB1 from Source to Target. No seat assignment.", $card->getTripDescription(), "Incorrect trip description");
    }
}