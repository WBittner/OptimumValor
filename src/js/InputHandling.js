

function grabAPIInputs()
{
	//first grab the possible inputs from the API

	$.ajax({
		url: "http://localhost/optval/php/GetSelectables.php",
		success: function(data){
					processInputs(data);
		},
		error: function(xhr, ajaxOptions, thrownError){
				console.log("Error on input ajax call\n" + xhr.status + "\n" + thrownError + "\nURL: " + URL);
	}
	})
}


function processInputs(data)
{
	data = JSON.parse(data);
	var maps = data["maps"];
	var modes = data["modes"];

	var div = document.getElementById("selectors");

	createDropdown(div, maps, "maps");
	createDropdown(div,modes,"modes");

	createSubmitButton(div);


	$p = document.getElementById("p");
	$p.innerHTML = "";
}


function createDropdown(div, arrayOfOptions, id)
{
	//add to div
	var select = document.createElement("select");
	select.id = id;
	div.appendChild(select);

	//populate
	for (var i = 0; i < arrayOfOptions.length; i++) 
	{
		var option = document.createElement("option");
		option.value = arrayOfOptions[i];
		option.text = arrayOfOptions[i];
		select.appendChild(option);
	}

}

function createSubmitButton(div)
{
	var button = document.createElement("button");
	button.innerHTML = "Submit";
	button.id="submit";
	button.addEventListener("click", submit);
	div.appendChild(button);


}

function submit()
{
	var map = document.getElementById("maps");
	var mode = document.getElementById("modes");

	//alert("Chosen:" + maps.value + modes.value);

	window.location.href = "http://localhost/optval/php/PostSelectables.php?map=" + map.value + "&mode=" + mode.value;


}