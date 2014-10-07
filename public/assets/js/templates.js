Templates = {};

$(document).ready(function() {
  $.ajax({
  	url:'templates/load',
  	type:'get',
  	dataType:'text',
  	data:{template:'post'},
  	success:function(templatesStrings){
  		Templates.post = templatesStrings;
  		onTemplatesLoaded();
  	},
  	error:function(a,b,c){
  	    console.log(a);
  	}
  });
});