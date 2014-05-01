$(function(){
    //INICIO -- jTrezza LightBox
    $('body').append('<div id="mambaNegra" style="width:100%;position:absolute;left:0;top:0;z-index:9000;background-color:#4A628D;display:none;"></div>');
    $("#mambaNegra").css("height", $(document).height());

    var jTrezza = new Object();
    jTrezza.lhtBox = function(eleMost){
        this.eleMost = eleMost;
    }
    jTrezza.lhtBox.prototype.mostrar = function(){
        $("#mambaNegra").css("height", $(document).height());
        $('#mambaNegra').fadeTo('fast',0.8);
        var lbVenAlto = $(window).height();
        var lbVenAncho = $(window).width();
        $('#'+this.eleMost).css('position','fixed');
        $('#'+this.eleMost).css('z-index','9001');
        
        $('#'+this.eleMost).css('top',  lbVenAlto/2-$('#'+this.eleMost).height()/2);
        $('#'+this.eleMost).css('left', lbVenAncho/2-$('#'+this.eleMost).width()/2);

        var idEle = this.eleMost;
        setTimeout(function(){$('#'+idEle).show(); $('#txaPost').focus();},200);  //$('#'+this.eleMost).show();      
    }
    jTrezza.lhtBox.prototype.reubicar = function(){
        var lbVenAlto = $(window).height();
        var lbVenAncho = $(window).width();
        $('#'+this.eleMost).css('top',  lbVenAlto/2-$('#'+this.eleMost).height()/2);
        $('#'+this.eleMost).css('left', lbVenAncho/2-$('#'+this.eleMost).width()/2);
    }
    jTrezza.lhtBox.prototype.cerrar = function(){
        $('#mambaNegra').hide();
        $('#'+this.eleMost).hide();
    }
    //FIN -- jTrezza LightBox
    cajaPost = new jTrezza.lhtBox("cajaPost");

    $("#mambaNegra").click(function(){
        cajaPost.cerrar();
    });
});