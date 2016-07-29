<?php
// This file contains the MasteriesFetcher class which will grab the list of masteries from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class MasteriesFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{

		$this->url = getStaticDataURL()."mastery".getFormattedAPIKey();
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$masteryList = $json["data"];

		return $masteryList;
	}


}


?>