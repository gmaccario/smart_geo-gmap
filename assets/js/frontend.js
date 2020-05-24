/**
*
* Events
*
*/
var smartgeojson_toggle = document.querySelector('.smartgeojson.wrapper #legend .header .toggle');
if (typeof smartgeojson_toggle !== 'undefined' && smartgeojson_toggle !== null)
{
	smartgeojson_toggle.addEventListener('click', toggleLegend, false);
}

/**
*
* Events functions
*
*/
function toggleLegend(event)
{
	let legend_toggle = document.querySelector('.smartgeojson.wrapper #legend .header .toggle');

	let legend_content_wrapper = document.querySelector('.smartgeojson.wrapper #legend .body');

	if(legend_content_wrapper.classList.contains('hide'))
	{
		legend_content_wrapper.classList.remove('hide');

		legend_toggle.classList.add('minus');
		legend_toggle.classList.remove('plus');
	}
	else{
		legend_content_wrapper.classList.add('hide');

		legend_toggle.classList.add('plus');
		legend_toggle.classList.remove('minus');
	}
}

/**
*
* Helper functions
*
*/
function printdebug(label = 'debug', par0 = '', par1 = '', par2 = '', par3 = '', par4 = ''){

	//console.log(label, par0, par1, par2, par3, par4);
}

function setSnazzyStyle()
{
	printdebug("snazzyStyleJson", snazzyStyleJson);

	return snazzyStyleJson;
}

function setMap()
{
	let mapOptions = {
		zoom: default_zoom,

		mapTypeControl: false,

		streetViewControl: false,

		center: new google.maps.LatLng( coord_center_1[ 'lat'], coord_center_1[ 'lng'] ),
	};

	printdebug("Zoom and coords", default_zoom, coord_center_1[ 'lat'], coord_center_1[ 'lng']);

	let mapElement = document.getElementById('smart-geo-gmap');

	map = new google.maps.Map( mapElement, mapOptions );

	map.setOptions({ styles: setSnazzyStyle() });

	for(let i = 0; i < geojson_files.length; i++)
	{
		printdebug("Geo json files", geojson_files[i]);

		map.data.loadGeoJson(geojson_files[i]);
	}
}

function setCenterControls()
{
	printdebug("custom_centers", custom_centers);

	for(let i = 0; i < custom_centers.length; i++){
		if(custom_centers[i].coord_center.lat != '0,0' && custom_centers[i].coord_center.lng != '0,0')
		{
			let centerControlDiv = document.createElement('div');
			let centerControl = new CenterControl(centerControlDiv, map, custom_centers[i].coord_center, custom_centers[i].label);

			centerControlDiv.index = i;
			map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
		}
	}
}

function CenterControl(controlDiv, map, coord_center, message)
{
	/**
	* Set CSS for the control border.
	*/
	let controlUI = document.createElement('div');
	controlUI.className = "control_border";
	controlUI.title = sz_recenter_control;
	controlDiv.appendChild(controlUI);

	/**
	* Set CSS for the control interior.
	*/
	let controlText = document.createElement('div');
	controlText.className = "control_interior";
	controlText.innerHTML = message;
	controlUI.appendChild(controlText);

	/**
	* Setup the click event listeners: simply set the map to desidered center lat/lng.
	*/
	controlUI.addEventListener('click', function() {
		map.setZoom(default_zoom);
		map.setCenter(new google.maps.LatLng(
			coord_center.lat,
			coord_center.lng
		));
	});
}

function setInfoWindows()
{
	let infowindow = new google.maps.InfoWindow();

	map.data.addListener(js_evt_info_windows, function(event) {

		let showTooltip = false;

		let features = event.feature;

		let markerInfo = '<ul>';
		features.forEachProperty(function(featureValue, featureIndex){
			if( featureValue != '' && featureValue != null )
			{
				let friendlyFeatureIndex = featureIndex.split('_').join(' ');
				friendlyFeatureIndex = friendlyFeatureIndex.charAt(0).toUpperCase() + friendlyFeatureIndex.slice(1);

				markerInfo = markerInfo + '<li>' + friendlyFeatureIndex + ': ' + featureValue + '</li>';

				showTooltip = true;
			}
		});
		markerInfo = markerInfo + '</ul>';

		if(showTooltip)
		{
			infowindow.setContent(markerInfo);

			infowindow.setPosition(event.latLng);

			infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});

			infowindow.open(map);
		}
	});
}

function setLegend()
{
	let legend = document.getElementById('legend');

	if(legend != ''){
		let pos = '';
		switch(legend_position)
		{
			case 'TOP_CENTER':
				pos = google.maps.ControlPosition.TOP_CENTER;
				break;
			case 'LEFT_CENTER':
				pos = google.maps.ControlPosition.LEFT_CENTER;
				break;
			default:
				pos = google.maps.ControlPosition.LEFT_TOP;
				break;
		}

		map.controls[pos].push(legend);
	}
}

/**
*
* Map functions
*
* Make sure that initMap function is visible from the global scope
*
*/
window.initMap = function(){

	let mapElement = document.getElementById('smart-geo-gmap');

	if (typeof mapElement !== 'undefined' && mapElement !== null)
	{
		setMap();
		//setLegend(); // @todo I removed legend references
		setCenterControls();
		setInfoWindows();
	}
}
