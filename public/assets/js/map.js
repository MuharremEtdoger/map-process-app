if($('.color-picker').length>0){
    $('.color-picker').spectrum({
        type: "component",
        preferredFormat: "hex",
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
       myPlacemark = new ymaps.Placemark([_latitude, _longitude]);
       myMap.geoObjects.add(myPlacemark);
       $('.single .bg-overlay').css('display','none');
    }	
}
