Templates = {};

$(document).ready(function() {
  $.ajax({
  	url:'',
  	type:'',
  	dataType:'json',
  	success:function(templatesStrings){
  		Templates = templatesStrings;
  		onTemplatesLoaded();
  	}
  });
});