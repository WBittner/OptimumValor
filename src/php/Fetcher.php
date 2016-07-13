<?php
// This file contains the Fetcher class which will include common functions and fields needed to access data from the League of Legends API.
//	It will be extended by classes to grab specific pieces of data.

require_once("Toolbox.php");

abstract class Fetcher
{

	protected $url;

	// Constructor
	function __construct()
	{

	}
	

	// Use URL to make API call then call process function to deal with results
	public function getData()
	{

		// As we can't assure that all subclasses will define their url, we should probably handle the case when they don't
		if(!isset($this->url))
		{
			$this->processError("URL is not set");
			return null; //this will allow object instantiators to simply use isset to determine the call was attemped
		}

		// Get cURL resource
		$curl = curl_init($this->url);

		// Return the result as a string rather than ouputting directly
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// Have curl fail on error so we can handle things like http errors with curl_error
		curl_setopt($curl, CURLOPT_FAILONERROR, true);

		// Execuse cURL request
		$result = curl_exec($curl);

		// Record any potential error before closing resource
		$err = curl_error($curl);

		// Close resource
		curl_close($curl);

		if($err)// Error was found
		{
			return ($this->processError($err));
		}
		else// No error was found
		{
			return ($this->processData($result));
		}

	}

	abstract protected function processData($result);

	protected function processError($error)
	{
		return $error;
	}



}


?>