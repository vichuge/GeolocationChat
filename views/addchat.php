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
                    
                    <!--<div class="row">
                        <div class="col s12">
                            <button class="btn btn-warning-confirm waves-effect waves-light" type="button" onclick="moverMarker()">Mover marker</button>
                        </div>
                    </div>-->
                    

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
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>-->
    <!--google map-->
    <!--<script type="text/javascript" src="<?php echo $raiz ?>resources/materialized/js/plugins/google-map/google-map-script.js"></script>-->
    
    
    
    <script type="text/javascript">
    
    $( document ).ready(function() {
        console.log('document.ready');
        loadPosition();
        //setMapa();
    });
    var lon;
    var lat;
    var marker;
    var map;
    var coords;
    var cityCircle;
    var radius;
    var mapFlag=0;
        
    
    function loadLog(latpos,lonpos){
        lon=lonpos;
        lat=latpos;
        if(mapFlag==0){
           setMapa();
           mapFlag=1;
        }
        moverMarker();
        
    }
    
    function setMapa() {
        //loadPosition();
        console.log('setMapa');
        if(lon!=="" && lat !==""){
            coords =  {
                lng: lon,
                lat: lat
            };
            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 17,
              center:new google.maps.LatLng(coords.lat,coords.lng)
            });
        }else{
            console.log("no coords");
        }
            
        
    
        //marker1
        marker = new google.maps.Marker({
            draggable: false,
            position: new google.maps.LatLng(coords.lat,coords.lng),
            map: map
        });
        document.getElementById("coords").value = marker.getPosition().lat();
        document.getElementById("coords2").value = marker.getPosition().lng();
        marker.addListener( 'drag', function (event)
        {
            document.getElementById("coords").value = this.getPosition().lat();
            document.getElementById("coords2").value = this.getPosition().lng();
            //distancebtwn
            //document.getElementById("distancebtwn").value = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(coords), new google.maps.LatLng(pos2));
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

        if(cityCircle){
            cityCircle.setMap(null);
        }
        cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            //center: {lat: 20.9948250, lng: -89.670734},
            center:{lat: lat, lng: lon},
            radius: radius
        });
    }

    function initCircle(){
        if(cityCircle){
            cityCircle.setMap(null);
        }
        cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            //center: {lat: 20.9948250, lng: -89.670734},
            center:{lat: lat, lng: lon},
            radius: radius
        });
    }
    
    function moverMarker(){
        //lon=lon+0.0001;
        //lat=lat+0.0001;
        coords =  {
            lng: lon,
            lat: lat
        };
        marker.setPosition( new google.maps.LatLng(coords.lat,coords.lng) );
        map.panTo( new google.maps.LatLng(coords.lat,coords.lng) );
        console.log(this.lat+','+this.lon);
        initCircle();
        document.getElementById("coords").value = marker.getPosition().lat();
        document.getElementById("coords2").value = marker.getPosition().lng();
        console.log('moverMarker');
    }
    
        $("#range_02").ionRangeSlider({
            min: 10,
            max: 200,
            from: 30,
            onStart: function (data) {
                //refreshData();
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

    /*var saveResult=function (data){
        console.log("entrooooooooooooooooo");
        from=data.from;
    }*/

      /*function refreshData()
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
      }*/
    </script>
    
    <?php
    include_once('position.php');
    ?>
    
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek&libraries=geometry">
    </script>
    
</body>
</html>