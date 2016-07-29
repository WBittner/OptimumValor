<?php
// The purpose of this file will be to provide all of the necessary functions for creating a build once all of the inputs are given
require_once("Toolbox.php");
require_once("ChampionsFetcher.php");
require_once("MapsFetcher.php");
require_once("ItemsFetcher.php");
require_once("MasteriesFetcher.php");
require_once("RunesFetcher.php");
require_once("SummonerSpellsFetcher.php");


function createBuild($map,$mode)
{
	//Get 1 boot, 5 nonboot
	$if = new ItemsFetcher();
	$items = $if->getData();
	$boot = GetXRandomElementsFromArrayYAndReturnZFields(1, $items[$map]["boots"], array("name"=>"force object"));
	$nonboots = GetXRandomElementsFromArrayYAndReturnZFields(5, $items[$map]["nonboots"], array("name"=>"force object"));

	$itemBuild =  array_merge($boot, $nonboots);

	//Get 2 ss
	$ssf = new SummonerSpellsFetcher();
	$ss = $ssf->getData();
	$ssBuild = GetXRandomElementsFromArrayYAndReturnZFields(2, $ss[$mode], array("name"=>"force object"));


	//Get masteries
	$mBuild = basicMasteryComputer();

	$build = array("items"=>$itemBuild, "summoners"=>$ssBuild, "masteries"=>$mBuild);

	return $build;
}


function basicMasteryComputer()
{
	//I know this is crappy randomness. Sorry..
	$masteries[0] = mt_rand(0,30);

	$masteries[1] = mt_rand(0,30-$masteries[0]);

	$masteries[2] = 30-array_sum($masteries);

	shuffle($masteries);

	return $masteries;

}


?>