var map;

jQuery(document).ready(function($) {
	var latTextfield = $('#ait-_ait-dir-item-gpsLatitude');
	var lonTextfield = $('#ait-_ait-dir-item-gpsLongitude');

	var initLat = (latTextfield.val()) ? latTextfield.val() : 0;
	var initLon = (lonTextfield.val()) ? lonTextfield.val() : 0;

	console.log("lat", initLat);
	console.log("lon", initLon);

	var latRow = $('#ait-_ait-dir-item-gpsLatitude-option');
	var mapRow = $('<tr valign="top" id="ait-map-option"><td scope="row" class="ait-custom-fields-label"><label for="ait-map-select">Map</label></td><td><div id="ait-map-select"></div></td></tr>');

	latRow.before(mapRow);

	map = mapRow.find('#ait-map-select');
	map.width('95%').height(500);

	var marker = {
		values:[
			{latLng:[initLat, initLon]}
        ],
		options: {
			draggable: true
		},
		events: {
			position_changed: function(marker){
				var pos = marker.getPosition();

				latTextfield.val(pos.Ya);
				lonTextfield.val(pos.Za);
			}
		}
	}

	map.gmap3({
		map: {
			events: {
				click:function(mapLocal, event){
					map.gmap3({
						get: {
							name: "marker",
							callback: function(marker){
								marker.setPosition(event.latLng);
							}
						}
					});
				}
			},
			options: {
				center: [0,0],
				zoom: 3
			}
		},
		marker: marker
	});
});