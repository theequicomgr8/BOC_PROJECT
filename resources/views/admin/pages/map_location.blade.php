<!DOCTYPE html>
<html>
<head>
    <title>How to add multiple markers on google maps javascript</title>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YourAPIKey"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgvvPpyxo3IjhB-CMG7wCgCHcYvV7FJxU" async></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
     

      function InitMap(lat_long_details) 
      {

        var locations = [];
        for (i = 0; i < lat_long_details.length; i++) 
        {
         locations.push([
              [lat_long_details[i]['City'], lat_long_details[i]['Latitude'], lat_long_details[i]['Longitude'], i+1],
              
          ]);
        }
        
       /* var locations = [
            ['Expedien eSolution', 28.578380, 77.320220, 1],
            ['Sector 62', 28.6280, 77.3649, 2],
            // ['Red Fort', 28.663973, 77.241656, 3],
            // ['India Gate', 28.620585, 77.228609, 4],
            // ['Jantar Mantar', 28.636219, 77.213846, 5],
            // ['Akshardham', 28.622658, 77.277704, 6]
        ];
          */
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: new google.maps.LatLng(28.614884, 77.208917),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
               console.log(locations);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][0][1], locations[i][0][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }

    </script>
</head>
<body onload="InitMap({{$latlong_details}});">
    <!-- <h1>Show multiple locations on Google Maps using JavaScript</h1> -->
    <input type="hidden" id="od_vendor_id" value="{{$od_vendor_id}}">
    <input type="hidden" id="lat_long_details" value="{{$latlong_details}}">

    <div id="map" style="height: 500px; width: auto;">
    </div>
</body>
</html>