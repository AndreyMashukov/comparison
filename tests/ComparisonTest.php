<?php

namespace Tests;

use \AdService\Comparison;
use \PHPUnit\Framework\TestCase;

class ComparisonTest extends TestCase
    {

	/**
	 * Should give percent of strings compare
	 *
	 * @return void
	 */

	public function testShouldGivePercentOfStringsCompare()
	    {
		$addresses = [
		    100 => array(
			    "a"   => "Иркутск, Александра Невского, 15",
			    "b"   => "Иркутск, Александра Невского, 15",
			   ),
		    74 => array(
			    "a"   => "Иркутск, Александра Невского, 15",
			    "b"   => "Иркутск, А. Невского, 15",
			   ),
		    63 => array(
			    "a"   => "Александра Невского, 5",
			    "b"   => "А Невского, 5",
			   ),
		];

		foreach ($addresses as $percent => $data)
		    {
			$compare = new Comparison($data["a"], $data["b"]);
			$this->assertEquals($percent, $compare->percent);
		    }

	    } //end testShouldGivePercentOfStringsCompare()


	/**
	 * Should check match strings
	 *
	 * @return void
	 */

	public function testShouldCheckMatchStrings()
	    {
		$addresses = [
		    "1" => array(
			    "a"   => "им Героя Советского Союза В.В.Вильского, 8",
			    "b"   => "Вильского, 8",
			    "exp" => true,
			   ),
		    "2" => array(
			    "a"   => "Александра Невского, 15",
			    "b"   => "М. Конева, 15",
			    "exp" => false,
			   ),
		    "3" => array(
			    "a"   => "",
			    "b"   => "",
			    "exp" => false,
			   ),
		];

		foreach ($addresses as $expected => $data)
		    {
			$comparison = new Comparison($data["a"], $data["b"]);
			$this->assertEquals($data["exp"], $comparison->match);
		    }

	    } //end testShouldCheckMatchStrings()


    } //end class

?>
