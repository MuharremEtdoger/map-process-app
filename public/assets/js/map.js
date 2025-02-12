if($('.color-picker').length>0){
    $('.color-picker').spectrum({
        type: "component",
        preferredFormat: "hex",
    });
}
if($('#maps-show-area').length>0){
    var _data=$('input[name="locations_data"]').val();
    var mapArr = [];
    if(_data){
        var obj = jQuery.parseJSON(_data);       
        if(obj){
            $.each( obj.data, function( key, value ) {
                mapArr.push({
                    'id': value.id,
                    'name': value.name,
                    'url': '/location/'+value.id,
                    'latitude': value.latitude,
                    'longitude': value.longitude,
                    'color': value.color,
                });
            });
        }
        if(mapArr){
            createLocationsMap(mapArr);
        }
    }
}
function createLocationsMap( mapArr ) {
    ymaps.ready(function() {
        var myMap = new ymaps.Map('maps-show-area', {
                center: [mapArr[0].latitude, mapArr[0].longitude],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
        });
        if(mapArr){
            $.each(mapArr,function(key, value){
                myMap.geoObjects.add(
                    new ymaps.Placemark(
                        [value.latitude, value.longitude], 
                        {
                            balloonContent: value.name,
                        },
                        {
                            iconColor: value.color,
                        }
                    )
                );
            });
        }
    });
}
if($('#map-show-area').length>0){
    ymaps.ready(init);
    var myMap,myPlacemark,_latitude,_longitude;
    function init(){ 
      _latitude=$('#map-show-area').attr('data-latitude');
      _longitude=$('#map-show-area').attr('data-longitude');
      myMap = new ymaps.Map("map-show-area", {
               center: [_latitude, _longitude],
               zoom: 16
       });
       myPlacemark = new ymaps.Placemark([_latitude, _longitude],{},{
        iconColor: $('#map-show-area').attr('data-color'),
       });
       myMap.geoObjects.add(myPlacemark);
       $('.single .bg-overlay').css('display','none');
    }	
}
if($('#create-route-maps').length>0){
    var _data_source=[] ,_data_target=[];
    _data_source.push($('#create-route-maps').attr('data-source-latitude'));
    _data_source.push($('#create-route-maps').attr('data-source-longitude'));
    _data_target.push($('#create-route-maps').attr('data-target-latitude'));
    _data_target.push($('#create-route-maps').attr('data-target-longitude'));
    createRoute('create-route-maps',_data_source,_data_target);
}
function createRoute(divID, _data_source, _data_target) {
	ymaps.ready(init);
	function init() {
        console.log(_data_source);
        console.log(_data_target);
		var myMap = new ymaps.Map(divID, {
			center: [_data_source[0], _data_source[1]],
			zoom: 15
		}, {
			searchControlProvider: 'yandex#search'
		});
		var myGeoObject = new ymaps.GeoObject({
			geometry: {
				type: "LineString",
				coordinates: [
					[_data_source[0], _data_source[1]],
					[_data_target[0], _data_target[1]]
				]
			},
			properties: {
				hintContent: "I'm a geo object",
				balloonContent: "You can drag me"
			}
		}, {
			draggable: true,
			strokeColor: "#1FFF15",
			strokeWidth: 5
		});
        console.log(myGeoObject);
        myMap.geoObjects.add(myGeoObject);
	}
}