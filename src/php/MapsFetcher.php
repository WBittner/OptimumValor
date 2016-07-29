<?php
// This file contains the MapsFetcher class which will grab the list of maps from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class MapsFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{

		$this->url = getStaticDataURL()."map".getFormattedAPIKey();
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$mapList = $json["data"];

		return $mapList;
	}


}


?>