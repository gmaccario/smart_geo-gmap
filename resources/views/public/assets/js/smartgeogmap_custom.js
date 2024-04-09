/**
 *
 * Events
 *
 */
var smartgeojson_toggle = document.querySelector('.smartgeojson.wrapper #legend .header .toggle');
if (typeof smartgeojson_toggle !== 'undefined' && smartgeojson_toggle !== null) {
    smartgeojson_toggle.addEventListener('click', toggleLegend, false);
}

/**
 *
 * Events functions
 *
 */
function toggleLegend(event) {
    let legend_toggle = document.querySelector('.smartgeojson.wrapper #legend .header .toggle');

    let legend_content_wrapper = document.querySelector('.smartgeojson.wrapper #legend .body');

    if (legend_content_wrapper.classList.contains('hide')) {
        legend_content_wrapper.classList.remove('hide');

        legend_toggle.classList.add('minus');
        legend_toggle.classList.remove('plus');
    } else {
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
function printdebug(label = 'debug', par0 = '', par1 = '', par2 = '', par3 = '', par4 = '') {

    if (smartGeoGmapDebug) {
        console.log(label, par0, par1, par2, par3, par4);
    }
}

function setSnazzyStyle() {
    printdebug("snazzyStyleJson", snazzyStyleJson);

    return snazzyStyleJson;
}

function setSmartGeoGMap() {
    let mapElement = document.getElementById('smart-geo-gmap');

    let mapOptions = {
        zoom: default_zoom,

        mapTypeControl: false,

        streetViewControl: false,

        styles: setSnazzyStyle(),

        center: new google.maps.LatLng(coord_center_1['lat'], coord_center_1['lng']),
    };

    printdebug("Zoom and center", default_zoom, coord_center_1['lat'], coord_center_1['lng']);

    map = new google.maps.Map(mapElement, mapOptions);

    if (map_type !== '') {
        setMapType(map);
    }

    for (let i = 0; i < geojson_files.length; i++) {
        printdebug("Geo json files", geojson_files[i]);

        map.data.loadGeoJson(geojson_files[i]);
    }
}

function setMapType(map) {
    printdebug("Map type", map_type);

    map.setMapTypeId(google.maps.MapTypeId[map_type]);
}

function setCenterControls() {
    printdebug("custom_centers", custom_centers);

    for (let i = 0; i < custom_centers.length; i++) {
        if (custom_centers[i].coord_center.lat != '0,0' && custom_centers[i].coord_center.lng != '0,0'
            && custom_centers[i].coord_center.lat != '' && custom_centers[i].coord_center.lng != '') {
            let centerControlDiv = document.createElement('div');
            let centerControl = new CenterControl(centerControlDiv, map, custom_centers[i].coord_center, custom_centers[i].label);

            centerControlDiv.index = i;
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
        }
    }
}

function CenterControl(controlDiv, map, coord_center, message) {
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
    controlUI.addEventListener('click', function () {
        map.setZoom(default_zoom);
        map.setCenter(new google.maps.LatLng(
            coord_center.lat,
            coord_center.lng
        ));
    });
}

function setInfoWindows() {
    let infowindow = new google.maps.InfoWindow();

    map.data.addListener(js_evt_info_windows, function (event) {

        let showTooltip = false;

        let features = event.feature;

        let markerInfo = '<ul>';
        features.forEachProperty(function (featureValue, featureIndex) {
            if (featureValue != '' && featureValue != null) {
                let friendlyFeatureIndex = featureIndex.split('_').join(' ');
                friendlyFeatureIndex = friendlyFeatureIndex.charAt(0).toUpperCase() + friendlyFeatureIndex.slice(1);

                markerInfo = markerInfo + '<li>' + friendlyFeatureIndex + ': ' + featureValue + '</li>';

                showTooltip = true;
            }
        });
        markerInfo = markerInfo + '</ul>';

        if (showTooltip) {
            infowindow.setContent(markerInfo);

            infowindow.setPosition(event.latLng);

            infowindow.setOptions({pixelOffset: new google.maps.Size(0, -30)});

            infowindow.open(map);
        }
    });
}

function setLegend() {
    if (!showLegend) {
        return;
    }

    printdebug("SetLegend -> icons and position", icons, legend_position);

    const legend = document.getElementById("legend");

    for (const key in icons) {
        const type = icons[key];
        const name = type.name;
        const icon = type.icon;
        const div = document.createElement("div");

        printdebug("SetLegend -> icon", type, name, icon);

        div.innerHTML = '<img src="' + icon + '"> ' + name;

        if (typeof legend !== 'undefined'
            && legend !== null) {
            legend.appendChild(div);
        }
    }

    map.controls[google.maps.ControlPosition[legend_position]].push(legend);
}

/**
 *
 * Map functions
 *
 * Make sure that initMap function is visible from the global scope
 *
 */
window.initMap = function () {

    let mapElement = document.getElementById('smart-geo-gmap');

    if (typeof mapElement !== 'undefined' && mapElement !== null) {
        setSmartGeoGMap();
        setCenterControls();
        setInfoWindows();
        setLegend();
    }
}
