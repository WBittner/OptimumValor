<?php
// This file contains the ItemsFetcher class which will grab the list of items from the riot API

require_once("Toolbox.php");
require_once("Fetcher.php");

class ItemsFetcher extends Fetcher
{

	// Constructor
	function __construct()
	{
		// need consumable and purchasable, so we need "all" as we cant ask for 2 things...
		$this->url = getStaticDataURL()."item?itemListData=all".getFormattedAPIKey(true);
	}
	
	protected function processData($result)
	{
		// Turn the string into associative array
		$json = json_decode($result, true);

		// Grab the champ list out of the result
		$itemList = $json["data"];

		// Get maps
		$allMaps = array();

		foreach($itemList as $itemKey)
		{
			$maps = $itemKey["maps"];
			foreach($maps as $mapKey => $present)
			{
				if(!in_array($mapKey, $allMaps))
					$allMaps[] = $mapKey;
			}
		}
		
		//Make associative array with modes as keys
		$associativeAllMaps = array_fill_keys($allMaps, array("boots"=>array(), "nonboots"=>array()));

		foreach($itemList as $itemKey => $itemData)
		{	
			//make sure it's purchasable
			if($itemData["gold"]["purchasable"] && 
				//This is a bit hacky.. technically, we only want final tier items, however, the damn boots claim to be used in items that aren't actually in the list (my suspician is boot enchants which were removed) so we have to check if their "into"s are actually in the list 
				((!isset($itemData["into"])) || empty(array_intersect($itemData["into"], array_keys($itemList)))) && 
				//no consumables
				(!isset($itemData["consumed"]) || (isset($itemData["consumed"]) && $itemData["consumed"] == false)))
			{
				
				$maps = $itemData["maps"];
				foreach($maps as $map => $present)
				{
					if($present)
					{
						if(isset($itemData["tags"]) && in_array("Boots", $itemData["tags"]))
							$associativeAllMaps[$map]["boots"][] = $itemData;
						else
							$associativeAllMaps[$map]["nonboots"][] = $itemData;
					}
				}
			}
			
		}

		//filter removes maps with no items. The reason we are filtering twice is because the outer filter checks inside the map id, while the inner filter checks inside the boots/nonboots arrays
		return array_filter($associativeAllMaps, function($value){ return array_filter($value); }); 
	}

	// This function will return an array of the different "map" IDs for which at least one of the item may be bought
	public function getMaps()
	{
		$data = $this->GetData();

		return array_keys($data);
	}

}


?>