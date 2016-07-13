<?php
// This file contains the RunesFetcher class which will grab the list of runes from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class RunesFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{

		$this->url = getStaticDataURL()."rune".getFormattedAPIKey();
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$runesList = $json["data"];

		return $runesList;
	}


}


?>