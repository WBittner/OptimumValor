<?php
// This file contains the ChampionsDAO which will grab the list of champions from the riot API

require_once("Toolbox.php");
require_once("DAO.php");

class ChampionsDAO extends DAO
{

	// Constructor
	function __construct()
	{

		$this->url = getStaticDataURL()."champion".getFormattedAPIKey();
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$championList = $json["data"];

		return $championList;
	}


}


?>