# Trip Sorter

A simple class to generate sorted trips from an unsorted sequence of trip segments. <br />
Sort complexity: O(n)

## Dependencies

PHP 7

https://thishosting.rocks/install-php-on-ubuntu/

sudo apt-get update && sudo apt-get upgrade <br />
sudo apt install php php-xml php-mbstring php-intl <br />

Composer <br />

https://getcomposer.org/download/

	php composer.phar install

## Tests

	php composer.phar run-script test

## Docs 

The docs are generated under the docs folder. <br />
They can be generated using:

	php composer.phar run-script docs

# Usage

## Sorting a trip

	$args = [];
	$train = new TrainCard($source = "Barcelona", $target = "Madrid", $vehicleNumber = "45A");
	$train->SetSeatNumber("A2");
	$args []= $train;

	$bus = new BusCard($source = "Madrid", $target = "Malaga", $vehicleNumber = "KA78");
	$bus->SetSeatNumber("10");
	$args []= $bus;

	$sorter = new TripSorter();
	$trip = $sorter->sort($args);

## Displaying a trip

	$trip->printSummary();
	/*
		1. Take train 45A from Barcelona to Madrid. Sit in seat 45B.
		2. Take bus 45B from Madrid to Malaga. Sit in seat 45B.
		3. You have arrived at your final destination.
	*/
