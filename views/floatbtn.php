<div class="fixed-action-btn click-to-toggle">
    <a class="btn-floating btn-large" id="floatbtn">
        <i class="mdi-maps-traffic medium"></i>
    </a>
    <ul>
        <!--<li><a href="<?php echo $raiz?>home" class="btn-floating red" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><i class="large mdi-editor-format-list-bulleted"></i></a>
        </li>-->
        <li><a href="<?php echo $raiz?>newroom" class="btn-floating green darken-1" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><i class="mdi-content-add"></i></a>
        </li>
        <li><a href="<?php echo $raiz?>edit" class="btn-floating yellow darken-2" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><i class="large mdi-action-face-unlock"></i></a>
        </li>
        <!--<li><a href="<?php echo $raiz?>exit" class="btn-floating purple" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><i class="large mdi-content-reply"></i></a>
        </li>-->
        <li><a href="<?php echo $raiz?>friends" class="btn-floating red" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><i class="mdi-social-people"></i></a></li>
    </ul>
</div>
<script type="text/javascript">
    var open=0;

    $("#floatbtn").click(function() {
        if (open==0){
            open=1;
            //console.log('open='+open);
        }else{
            open=0;
            //console.log('open='+open);
        }
        
    });
    
    $(function(){				
				
        var $win = $(window); // or $box parent container
        var $box = $("#floatbtn");
        var $log = $(".log");
        
        $win.on("click.Bst", function(event){		
            if ( 
                $box.has(event.target).length == 0 //checks if descendants of $box was clicked
            &&
            !$box.is(event.target) //checks if the $box itself was clicked
            ){  
                //console.log("you clicked outside the box");
                if(open==1){
                    $('#floatbtn').click();
                }
            }
        });
    });
    
</script>