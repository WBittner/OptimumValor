#  Optimum Valor TO-DO doc
--------------------------

* ~~Gather the necessary data from RIOTS API~~
	* ~~Superclass to handle duplicate code~~
 	* ~~Champions~~
 	* ~~Maps~~
 	* ~~Items~~
 	* ~~Masteries~~
 	* ~~Runes~~
 	* ~~Summoner Spells~~

* Format/process data for base use - by map
 	* ~~Champions~~ - No change: The champions static data api does not have a map object in the return - all champs available for all maps!
 	* ~~Maps~~ - have a list with whatever map ID the items/summoner spells return that can easily be passed.
 	* ~~Items~~ - sort items into lists based on A)map B) boots/not and get rid of consumables and non-final tier items
 	* ~~Masteries~~ - No change: Masteries don't change by map
 	* ~~Runes~~ - No change: Runes don't change by map
 	* ~~Summoner Spells~~ - sort based on mode (map sorting not available)

* Randomizer
	* ~~Given list, num from list,choose.~~ 

* Input (realm api for pics?)
 	* Map (for items)
 		* ~~Send~~
 		* ~~Receive~~
 	* Match (for summoners)
 		* ~~Send~~
 		* ~~Receive~~
	* Champions - after v 1.0
 		* Send
 		* Receive
 	* Level - after v 1.0
 		* Send
 		* Receive

* Central tie together for beta release 
	* ~~Dropdowns and submit button for inputs~~
	* ~~Pick 1 boots item and 5 nonboots items(only map)~~
	* ~~Pick 2 ss(only match)~~
	* ~~Pick 3 random nums totaling 30(masteries)~~
	* ~~Output pretty printed JSON~~

* Make prettier
	* Images. Everything images. So many images.
	* Get map names/pictures for selector?

* Additional sorting/selecting options
	* Champions - all/role/lane, champ specific items
 	* Maps
 	* Items - dups?
 	* Masteries - #/precise
 	* Runes
 	* Summoner Spells