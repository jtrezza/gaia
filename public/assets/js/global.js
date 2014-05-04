$(document).ready(function(){
	$('#txaPost').keyup(function(){
		var text = $(this).val();
		var lon = text.length;
		resta = 140 - lon;
		$('#spaLimit').html(resta); 
	});
});
function cerrarDialogoPostear()
{
	cajaPost.cerrar();
}
function mostrarCajaPost()
{	
	$('#txaPost').val('');
	cajaPost.mostrar();
}
function postear()
{
	var msj = $('#txaPost').val();
	var id_usuario = $('#hdd_usuario_id').val();	
	var ruta = $('#hdd_ruta_post').val();
	
    $.post(ruta, {usuario:id_usuario,mensaje:msj}, function(result) {
            if(result.success){
            	cajaPost.cerrar();
            }else{
            	alert('Algo salió mal :(');
            }
    }, 'json');
}
function onTemplatesLoaded(){
	console.log('Templates are loaded.');
}