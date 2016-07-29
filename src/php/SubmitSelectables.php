<?php

if(!isset($_GET["map"]) || !isset($_GET["mode"]))
{
	echo array("error"=>"Map or mode not set");
}
else
{
	$map = $_GET["map"]
	$mode = $_GET["mode"]

	echo $map.$mode;
}

?>