<?php
// This file with provide miscellaneous functions or globals that will be used throughout the app


// This function will return my api key for the league of legends api
function getAPIKey()
{
	return "6664f4db-4da8-4d3b-a858-20dc58175f06";
}

// This function returns my API key formatted to fit at the end of a URL
function getFormattedAPIKey()
{
	return "?api_key=".getAPIKey();

}

// Get the entirety of the config file as JSON.
function getAPIConfig()
{
	$stringConfig = file_get_contents("../config/ApiConfig.json");

	$jsonConfig = json_decode($stringConfig,true);

	return $jsonConfig;
}

// Get the version of the given api from the config, null if not found in config
function getVersionFromConfig($api)
{
	$config = getAPIConfig();
	$versionConfig = $config["version"]; //should always be defined

	if(isset($versionConfig[$api]))
	{
		return $versionConfig[$api];
	}
	else
		return null;
}


// Return the URL for static data api 
function getStaticDataURL()
{
	return "https://global.api.pvp.net/api/lol/static-data/na/v".getVersionFromConfig("staticData")."/";
}


// Prints json nicely
function JSONPrettyPrint($json)
{
	echo "<pre>".json_encode($json, JSON_PRETTY_PRINT)."</pre>";
}

?>