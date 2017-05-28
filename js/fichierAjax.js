$(document).ready(function(){
	$('#myFichier').on('submit', function(e){
	   e.preventDefault();
	   $.ajax({
	        url: "Fichiers.php",
	        type: "POST",
	        data: new FormData(this),
	        contentType: false,
	        processData:false,
	   });  
	});  
 });