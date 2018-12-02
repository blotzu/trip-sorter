<?php
/**
 * The base boarding card class
 */
declare(strict_types=1);

namespace Lib\Cards;

/**
 * The base boarding card class
 */
abstract class BoardingCard
{
	/**
	 * The source location
	 * @var string
	 */
	private $source;

	/**
	 * The destination location
	 * @var string
	 */
	private $target;

	/**
	 * The base boarding class constructor
	 * @param string|string $source The source location
	 * @param string|string $target The destination location
	 */
	public function __construct(string $source = "", string $target = "")
	{
		if (!is_string($source) || $source === "")
		{
			throw new \InvalidArgumentException("Invalid source location");
		}
		if (!is_string($target) || $target === "")
		{
			throw new \InvalidArgumentException("Invalid target location");
		}

		$this->source = $source;
		$this->target = $target;
	}

	/**
	 * Returns the source location
	 * @return string
	 */
	public function getSource(): string
	{
		return $this->source;
	}

	/**
	 * Returns the destination location
	 * @return string
	 */
	public function getTarget(): string
	{
		return $this->target;
	}

	/**
	 * Returns the trip segment description
	 * @return string
	 */
	public abstract function getTripDescription(): string;
}
