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
function onTemplatesLoaded()
{
	//console.log('Templates are loaded.');
	setTimeout(loadPosts, 10000);
}
function loadPosts()
{
    var user_id = $('#hdd_usuario_id').val();
    var ultimo_post = $('#hdd_ultimo_post').val();
    var c_template = Mustache.compile(Templates.post);
    
    $.ajax({
      	url:'new_posts',
      	type:'get',
      	dataType:'json',
      	data:{user_id: user_id, ultimo_post:ultimo_post},
      	success:function(posts){
      	    var new_items = '';
      	    //console.log(posts);
      		$.each(posts, function(i, p){
      		    p.ago = 'ahora';
      		    new_items = new_items + c_template(p);
      		    ultimo_post = (p.id > ultimo_post) ? p.id : ultimo_post;
      		    if(p.user.id != user_id){
      		    	notify('@'+p.user.username, p.text_original, p.user.profile_picture);
      		    }
      		});
      		
      		$('#hdd_ultimo_post').val(ultimo_post);
      		$('.before-posts').after(new_items);
      		$('.post-template.oculto').show("slow");
      		
      		onTemplatesLoaded();
      	},
      	error:function(a,b,c){
      	    console.log('Error: '+b);
      	    loadPosts();
      	}
    });
}

function requestNotificationPermission()
{
    /*if (window.webkitNotifications){
        console.log('Existe el objeto');
        var havePermission = window.webkitNotifications.checkPermission();
        console.log('Variable vale: '+havePermission);
        if (havePermission != 0) {
            window.webkitNotifications.requestPermission();
        }
    }*/
    if ("Notification" in window && Notification.permission !== "granted") {
	    Notification.requestPermission();
	}else{
		alert('Las notificaciones de escritorio ya han sido activadas.');
	}
}

function notify(title, text, photo_name) {
	

      // Let's check if the user is okay to get some notification
      if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        var noti = new Notification(title,{body:text, icon:'/uploads/'+photo_name});
        noti.onshow = function(){
        	setTimeout(function(){noti.close();}, 7000);
        }
        
      }

      // Otherwise, we need to ask the user for permission
      // Note, Chrome does not implement the permission static property
      // So we have to check for NOT 'denied' instead of 'default'
      else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {

          // Whatever the user answers, we make sure we store the information
          if(!('permission' in Notification)) {
            Notification.permission = permission;
          }

          // If the user is okay, let's create a notification
          if (permission === "granted") {
            var noti = new Notification(title,{body:text, icon:'/uploads/'+photo_name});
            noti.onshow = function(){
	        	setTimeout(function(){noti.close();}, 7000);
	        }
          }
        });
      }
  /*if (!window.webkitNotifications) return;  // not webKit, so no notifications available
  var havePermission = window.webkitNotifications.checkPermission();
  if (havePermission == 0) {
    // 0 is PERMISSION_ALLOWED
    var notification = window.webkitNotifications.createNotification(
      '/uploads/'+photo_name,
      title,
      text
    );
    
    notification.onclick = function () {
      window.open("http://appgaia.tk");
      // the notification will close itself after being clicked
    }
    notification.ondisplay = function (){
    	setTimeout(function(){
    		notification.cancel();
    	}, 7000);
    }
    notification.show();
  } else {
      window.webkitNotifications.requestPermission();
  }*/
}