<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Rectangles</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>

      // This example adds a red rectangle to a map.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: {lat: -6.8585, lng: 107.42},
          mapTypeId: 'terrain'
        });

        var rectangle = new google.maps.Rectangle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.05,
          map: map,
          bounds: {
            north: -6.836, //LINTANG A
            south: -6.881, //LINTANG B
            east: 107.443, //BUJUR A
            west: 107.397 //BUJUR B
          }
        });
      }
    </script>
  </head>
  <body>
    <div id="map"></div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZGCoJLniH-3xUOaBlX2aKrkG6KNeRecM&callback=initMap">
    </script>
  </body>
</html>