<?php
/*$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "rol1" && $nomrol !="rol2") { //esta línea ira dependiendo quienes se desea que puedan entrar al script.
    header('Location: ' . $raiz . '');
}*/
?>

<?php
include_once('head.php');
?>
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
</head>
<body>

    <?php
    include_once('header.php');
    ?>

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <?php
            include_once('navbar.php');
            ?>
            <!-- START CONTENT -->
            <section id="content">
                <!-- Aqui va el código-->
                <div class="row">
                    <div class="col s12">
                        <h3>My Google Maps Demo</h3>
                        <div id="map"></div>
                        <button onclick="initCircle();">Trazar</button>
                        <button onclick="calcdist();">Calcular distancia</button>
                        <input type="text" size="500px" id="coords"></input>
                        <input type="text" size="500px" id="coords2"></input>

                        <div id="range_02"></div>

                    </div>
                </div>
            </section>
            <!-- END CONTENT -->
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <?php
    include_once('scripts.php');
    ?>
    <script>
      var mapping;
      var lati;
      var long;
      var lati2;
      var long2;
      var pos1;
      var pos2;
      var cityCircle;
      var radius;

      function initMap() {
        setInterval(function(){
          //console.log("si");
          //console.log(radius);
        },500);

        //usamos la API para geolocalizar el usuario
        navigator.geolocation.getCurrentPosition(
          function (position){
            coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            
           
          },function(error){console.log(error);});
      }

      function setMapa() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center:new google.maps.LatLng(coords.lat,coords.lng),
        });
        mapping=map;

        var marker = new google.maps.Marker({
          draggable: true,
          position: new google.maps.LatLng(coords.lat,coords.lng),
          map: map
        });
        document.getElementById("coords").value = marker.getPosition().lat()+","+ marker.getPosition().lng();
        lati=marker.getPosition().lat();
        long=marker.getPosition().lng();
        pos1={lat: lati ,lng: long};

        var marker2 = new google.maps.Marker({
          draggable:true,
          position: new google.maps.LatLng(coords.lat,coords.lng),
          map: map
        });
        document.getElementById("coords2").value = marker2.getPosition().lat()+","+ marker2.getPosition().lng();
        lati2=marker2.getPosition().lat();
        long2=marker2.getPosition().lng();
        pos2={lat: lati2 ,lng: long2};

        marker.addListener( 'drag', function (event)
        {
          document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
          lati=this.getPosition().lat();
          long=this.getPosition().lng();
          pos1={lat: this.getPosition().lat() ,lng: this.getPosition().lng()};
        });

        marker2.addListener( 'drag', function (event)
        {
          document.getElementById("coords2").value = this.getPosition().lat()+","+ this.getPosition().lng();
          lati2=this.getPosition().lat();
          long2=this.getPosition().lng();
          pos2={lat: this.getPosition().lat() ,lng: this.getPosition().lng()};
        });

      }

      function initCircle(){
        var latcir=lati;
        var loncir=long;
        if(cityCircle){
          cityCircle.setMap(null);
        }
        cityCircle = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: mapping,
          //center: {lat: 20.9948250, lng: -89.670734},
          center:{lat: latcir, lng: loncir},
          radius: radius
        });
      }

      function calcdist(){
        var dist=google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(pos1), new google.maps.LatLng(pos2));

        //console.log(dist);
        if(dist<=radius){
          console.log("+ conversación");
        }else{
          console.log("- conversación");
        }
      }

    </script>

        

    <script>
      $("#range_02").ionRangeSlider({
            min: 10,
            max: 200,
            from: 30,
            onStart: function (data) {
        console.log("onStart");
        radius=data.from;
    },
    onChange: function (data) {
        //console.log("onChange");
        radius=data.from;
        initCircle();
    },
    onFinish: function (data) {
        //console.log("onFinish");
        radius=data.from;
    },
    onUpdate: function (data) {
        console.log("onUpdate");
    }
          });

      var saveResult=function (data){
        console.log("entrooooooooooooooooo");
        from=data.from;
      }

    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek&callback=initMap&libraries=geometry">
    </script>
</body>
</html>