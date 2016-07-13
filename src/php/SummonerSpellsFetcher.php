<?php
// This file contains the SummonerSpellsFetcher class which will grab the list of summoner spells from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class SummonerSpellsFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{

		$this->url = getStaticDataURL()."summoner-spell".getFormattedAPIKey();
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$summonerSpellsList = $json["data"];

		return $summonerSpellsList;
	}


}


?>