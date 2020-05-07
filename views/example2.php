<!DOCTYPE html>
<html>
  <head>
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <button onclick="initCircle();">Trazar</button>
    <input type="text" size="500px" id="coords"></input>
    <script>
      var mapping;
      var lati;
      var long;

      function initMap() {
        var uluru = {lat: 20.9948250, lng: -89.670734};
        var uluru2 = {lat: 20.9951250, lng: -89.670734};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: uluru
        });
        mapping=map;

        var marker = new google.maps.Marker({
          draggable: true,
          position: uluru,
          map: map
        });
        document.getElementById("coords").value = marker.getPosition().lat()+","+ marker.getPosition().lng();
        lati=marker.getPosition().lat();
        long=marker.getPosition().lng();

        var marker2 = new google.maps.Marker({
          position: uluru2,
          map: map
        });

        var dist=google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(uluru), new google.maps.LatLng(uluru2));

        console.log(dist);

        marker.addListener( 'dragend', function (event)
        {
          document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
          lati=this.getPosition().lat();
          long=this.getPosition().lng();
        });

      }

      function initCircle(){
        var latcir=lati;
        var loncir=long;
        var cityCircle = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: mapping,
          //center: {lat: 20.9948250, lng: -89.670734},
          center:{lat: latcir, lng: loncir},
          radius: 10
        });
      }

      $(document).ready(function(){

        $("#coords").mouseup(function(){
          console.log("Mouse up over p1!");
        });

        $("#coords").mousedown(function(){
          console.log("Mouse down over p1!");
        });

      });

      

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=geometry">
    </script>
  </body>
</html>

<!-- API key
AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek
-->