<?php
include_once('candado.php');
?>

<?php
include_once('head.php');
?>

<style>
    label {
    font-size: 1rem;
    color: #9e9e9e;
    }
    #date {
    float: right;
    color: #ff4081;
    }
    /*.sidebar-collapse {
    position: absolute;
    left: -170px;
    top: 30px;
    }*/
    #map {
        height: 200px;
        width: 100%;
    }
    a{
      color: #ffffff;
    }
</style>
</head>
<body>

    <?php
    //include_once('header.php');
    ?>

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <?php
            //include_once('navbar.php');
            ?>
            <!-- START CONTENT -->
            <section id="content">
                <ul id="task-card" class="collection with-header">
                    <li class="collection-header cyan">
                      <h5 class="task-card-title"><a href="<?php echo $raiz?>home"><i class="mdi-navigation-arrow-back"></i></a>Agregar sala</h5>
                    </li>
                </ul>
                <br/>

                <div class="row">
                    <div class="col s12">
                        <div id="map"></div> 
                    </div>
                </div>

                <div class="row">
                  <form class="login-form" method="POST" action="<?php echo $raiz?>crearsala">
                    <div class="row">
                        <div class="col s12">
                            <input type="hidden" id="coords" name="lat" readonly="true"></input>
                            <input type="hidden" id="coords2" name="lon"  readonly="true"></input> 
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col s12">
                            <input type="text" id="coords3" name="lat" readonly="true"></input>
                            <input type="text" id="coords4" name="lon"  readonly="true"></input> 
                        </div>
                    </div>-->
                    <!--<div class="row">
                        <div class="col s12">
                            <input type="text" id="distancebtwn" name="lat" readonly="true"></input>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col s12">
                            <button class="btn btn-warning-confirm waves-effect waves-light" type="button" onclick="initCircle()">Fijar mi posición</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                             <!--<button class="btn btn-warning-confirm waves-effect waves-light" onclick="calcdist();">Calcular distancia</button>-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <div id="range_02"></div>
                        </div>
                        <div class="col s12">
                            <input type="hidden" name="radio" id="valradio" readonly="true" value="" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Escribe aqui..." name="nomsala" type="text" class="validate" required>
                            <label for="first_name" class="active">Nombre de la sala</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <button class="btn btn-warning-confirm waves-effect waves-light" type="submit">Crear</button>
                        </div>
                    </div>
                    
                </form>
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
    
    <?php
    include_once('floatbtn.php');
    ?>
    
    <!-- google maps api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
    <!--google map-->
    <script type="text/javascript" src="<?php echo $raiz ?>resources/materialized/js/plugins/google-map/google-map-script.js"></script>

    <script type="text/javascript">
        (function(){
            //var content = document.getElementById("geolocation-test");
            navigator.geolocation.watchPosition(function(objPosition)
            {
            var lon = objPosition.coords.longitude;
            var lat = objPosition.coords.latitude;

            //Aqui se captura la posición

            }, function(objPositionError)
            {
                switch (objPositionError.code)
                {
                    case objPositionError.PERMISSION_DENIED:
                    content.innerHTML = "No se ha permitido el acceso a la posición del usuario.";
                    location.href ="<?php echo $raiz ?>";
                    break;
                    case objPositionError.POSITION_UNAVAILABLE:
                    content.innerHTML = "No se ha podido acceder a la información de su posición.";
                    location.href ="<?php echo $raiz ?>";
                    break;
                    case objPositionError.TIMEOUT:
                    content.innerHTML = "El servicio ha tardado demasiado tiempo en responder.";
                    location.href ="<?php echo $raiz ?>";
                    break;
                    default:
                    content.innerHTML = "Error desconocido.";
                    location.href ="<?php echo $raiz ?>";
                }
            }, {
                //maximumAge: 75000,
                //timeout: 15000
            });
        })();

      var mapping;
      var lati;
      var long;
      //var lati2;
      //var long2;
      var pos1;
      //var pos2;
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
          zoom: 17,
          center:new google.maps.LatLng(coords.lat,coords.lng)
        });
        mapping=map;
        
        //marker1
        var marker = new google.maps.Marker({
          draggable: false,
          position: new google.maps.LatLng(coords.lat,coords.lng),
          map: map
        });
        document.getElementById("coords").value = marker.getPosition().lat();
        document.getElementById("coords2").value = marker.getPosition().lng();
        lati=marker.getPosition().lat();
        long=marker.getPosition().lng();
        pos1={lat: lati ,lng: long};
        marker.addListener( 'drag', function (event)
        {
          document.getElementById("coords").value = this.getPosition().lat();
          document.getElementById("coords2").value = this.getPosition().lng();
          lati=this.getPosition().lat();
          long=this.getPosition().lng();
          pos1={lat: this.getPosition().lat() ,lng: this.getPosition().lng()};
          //distancebtwn
          document.getElementById("distancebtwn").value = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(pos1), new google.maps.LatLng(pos2));
        });
        
        //var dist=google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(pos1), new google.maps.LatLng(pos2));
        
        //marker2
        /*var marker2 = new google.maps.Marker({
          draggable:true,
          position: new google.maps.LatLng(coords.lat,coords.lng),
          map: map
        });
        document.getElementById("coords3").value = marker2.getPosition().lat(); 
        document.getElementById("coords4").value = marker2.getPosition().lng();
        lati2=marker2.getPosition().lat();
        long2=marker2.getPosition().lng();
        pos2={lat: lati2 ,lng: long2};
        marker2.addListener( 'drag', function (event)
        {
          document.getElementById("coords3").value = this.getPosition().lat();
          document.getElementById("coords4").value = this.getPosition().lng();
          lati2=marker2.getPosition().lat();
          long2=marker2.getPosition().lng();
          pos2={lat: lati2 ,lng: long2};
          document.getElementById("distancebtwn").value = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(pos1), new google.maps.LatLng(pos2));
        });*/
        
        //distancebtwn
        //document.getElementById("distancebtwn").value = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(pos1), new google.maps.LatLng(pos2));
        
        /*function calcdist(){
            var dist=google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(pos1), new google.maps.LatLng(pos2));

            if(dist<=radius){
              console.log("+ conversación");
            }else{
              console.log("- conversación");
            }
        }*/

        //crear circunferencia
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

      

    </script>

       

    <script>
      $("#range_02").ionRangeSlider({
            min: 10,
            max: 200,
            from: 30,
            onStart: function (data) {
        console.log("onStart");
        refreshData();
        radius=data.from;
        $('#valradio').val(data.from);
    },
    onChange: function (data) {
        //console.log("onChange");
        radius=data.from;
        initCircle();
        $('#valradio').val(data.from);
        
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

      function refreshData()
      {
          //posición
            navigator.geolocation.getCurrentPosition(
              function (position){
                coords =  {
                  lng: position.coords.longitude,
                  lat: position.coords.latitude
                };
              },function(error){console.log(error);});
            
          //initcircle();
        //console.log('hola');
        setTimeout(refreshData, 1000);
        //map.setCenter(new google.maps.LatLng(coords.lat,coords.lng));
      }
    </script>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek&callback=initMap&libraries=geometry">
    </script>

</body>
</html>