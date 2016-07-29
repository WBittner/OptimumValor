<?php
// This file contains the SummonerSpellsFetcher class which will grab the list of summoner spells from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class SummonerSpellsFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{
		// Modes adds a "modes" : [] object in each summoner spell obj. [] is list of map names for availability
		$this->url = getStaticDataURL()."summoner-spell?spellData=all".getFormattedAPIKey(true);
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$summonerSpellsList = $json["data"];

		//Grab an array of the modes
		$allModes = array();

		foreach($summonerSpellsList as $summonerKey)
		{
			$modes = $summonerKey["modes"];
			foreach($modes as $mode)
			{
				if(!in_array($mode, $allModes))
					$allModes[] = $mode;
			}
		}

		//Make associative array with modes as keys
		$associativeAllModes = array_fill_keys($allModes, array());

		foreach($summonerSpellsList as $summonerKey => $summonerData )
		{
			$modes = $summonerData["modes"];
			foreach($modes as $mode)
			{
				$associativeAllModes[$mode][] = $summonerData;
			}
		}

		return $associativeAllModes;
	}


	// This function will return an array of the different "modes" for which at least one of the summoner spells may be chosen
	public function getModes($summonerSpellsList = null)
	{
		$data = $this->GetData();

		return array_keys($data);
	}


}


?>