<?php
//This file will echo the selectable pieces that will be inputs into the the Optimum Bravery build calculator

require_once("Toolbox.php");
require_once("ItemsFetcher.php");
require_once("SummonerSpellsFetcher.php");

//grab maps
$itemF = new ItemsFetcher();
$availableMaps = $itemF->getMaps();

//grab modes
$ssF = new SummonerSpellsFetcher();
$availableModes = $ssF->getModes();

//return 
$retArr = array("maps"=>$availableMaps, "modes"=>$availableModes);

$prettyprint = isset($_GET['prettyprint']) ? true : false;
if(!$prettyprint)
	echo json_encode($retArr);
else
	JSONPrettyPrint($retArr);


?>