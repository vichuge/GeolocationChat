<script type="text/javascript">
    function loadPosition(){
        navigator.geolocation.watchPosition(function(objPosition)
            {
            console.log('loadPosition');
            var lonpos="";
            var latpos="";
            lonpos = objPosition.coords.longitude;
            latpos = objPosition.coords.latitude;
            
            this.lon=lonpos;
            this.lat=latpos;
            loadLog(latpos,lonpos);
            console.log('latitud='+lat+','+'longitud='+lon);
            
            
            //captura posición de la bd
            var uri='<?php echo $raiz ?>';
                $.ajax({
                    url: uri+'changeposition',
                    cache: false,
                    type : 'POST',
                    //dataType : 'json',
                    data: {
                        longitud: lonpos, 
                        latitud: latpos
                    },
                    success: function(){
                        //console.log('success');
                    },
                    error: function(){
                        //console.log('error');
                    }
                }); 
            
            }, function(objPositionError)
            {
                switch (objPositionError.code)
                {
                    case objPositionError.PERMISSION_DENIED:
                    content.innerHTML = "No se ha permitido el acceso a la posición del usuario. <a href='<?php echo $raiz ?>'>Reintentar</a>";
                    //location.href ="<?php echo $raiz ?>";
                    break;
                    case objPositionError.POSITION_UNAVAILABLE:
                    content.innerHTML = "No se ha podido acceder a la información de su posición. <a href='<?php echo $raiz ?>'>Reintentar</a>";
                    //location.href ="<?php echo $raiz ?>";
                    break;
                    case objPositionError.TIMEOUT:
                    content.innerHTML = "El servicio ha tardado demasiado tiempo en responder. <a href='<?php echo $raiz ?>'>Reintentar</a>";
                    //location.href ="<?php echo $raiz ?>";
                    break;
                    default:
                    content.innerHTML = "Error desconocido.";
                    //location.href ="<?php echo $raiz ?>";
                }
            }, {
                //maximumAge: 999999999999
                //timeout: 15000
            });      
    }
</script>
