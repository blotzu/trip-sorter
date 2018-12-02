<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lib\Cards\PlaneCard;

/**
 * The PlaneCard unit test class
 */
class PlaneCardTests extends TestCase  
{
    /**
     * Tests the card properties accessors return the correct values
     */
    public function test_AllProperties(): void
    {
        $card = new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "ABC", $gateNumber = "3", $seatNumber = "123");
        $card->setGateNumber("3");
        $card->setBaggageCounterNumber("43");

        $this->assertEquals("Source", $card->getSource(), "Incorrect source location");
        $this->assertEquals("Target", $card->getTarget(), "Incorrect target location");
        $this->assertEquals("ABC", $card->getVehicleNumber(), "Incorrect vehicle number");
        $this->assertEquals("123", $card->getSeatNumber(), "Incorrect seat number");
        $this->assertEquals("3", $card->getGateNumber(), "Incorrect gate number");
        $this->assertEquals("43", $card->getBaggageCounterNumber(), "Incorrect baggage counter number");
    }

    /**
     * Tests the card contructor arguments
     */
    public function test_Contructor_VehicleNumber_Missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new PlaneCard($source = "Source", $target = "Target", $gateNumber = "3", $seatNumber = "123");
    }

    /**
     * Tests the card contructor arguments
     */
    public function test_Constructor_VehicleNumber_EmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "", $gateNumber = "3", $seatNumber = "123");
    }

    /**
     * Tests the card contructor arguments
     */
    public function test_Contructor_GateNumber_Missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "123", $seatNumber = "123");
    }

    /**
     * Tests the card contructor arguments
     */
    public function test_Constructor_GateNumber_EmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "123", $gateNumber = "", $seatNumber = "123");
    }

    /**
     * Tests the card contructor arguments
     */
    public function test_Contructor_SeatNumber_Missing(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "123", $gateNumber = "3");
    }

    /**
     * Tests the card contructor arguments
     */
    public function test_Constructor_SeatNumber_EmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "123", $gateNumber = "3", $seatNumber = "");
    }

    /**
     * Tests the card properties accessors return the correct values
     */
    public function test_GetTripDescription_AllProperties(): void
    {
        $card = new PlaneCard($source = "Source", $target = "Target", $vehicleNumber = "AB1", $gateNumber = "3", $seatNumber = "123");

        $expectedDescription = "From Source, take flight AB1 to Target. Gate 3, seat 123." . PHP_EOL
. "Baggage will we automatically transferred from your last leg.";

        $this->assertEquals($expectedDescription, $card->getTripDescription(), "Incorrect trip description");
    }
}