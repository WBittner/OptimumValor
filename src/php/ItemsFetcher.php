<?php
// This file contains the ItemsFetcher class which will grab the list of champions from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class ItemsFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{

		$this->url = getStaticDataURL()."item".getFormattedAPIKey();
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$itemList = $json["data"];

		return $itemList;
	}


}


?>