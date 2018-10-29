<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
    </head>
    <body>
        
        
                <div style="height: 750px;z-index: 950;" id="map-canvas"></div>

    <footer></footer>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5xedHfQY8mhyxhGmURgAiJgWkwk0yhlM&callback=initMap" async defer></script>
    <script>
        var map;
        function initMap() {
            //                                            geocoder = new google.maps.Geocoder();
            var mapOptions = {
                zoom: 8,
                center: new google.maps.LatLng(-2.8441064, 115.568287),
                mapTypeId: google.maps.MapTypeId.HYBRID
            }
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        }
        google.maps.event.addDomListener(window, 'load', initMap);

        function lihatJalan() {
            var jalan = document.getElementById('kabupaten').value;

            var jalanLayar = new google.maps.KmlLayer({
                url: jalan,
                map: map,
                zoom: 30
            })

        }
    </script>
</body>
</html>
