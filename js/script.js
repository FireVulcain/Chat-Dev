$(document).ready(function() { 
	$(function(){
		 $('#myForm').ajaxForm({
		 	complete:function(response){
		 		if(response.responseText=='0')
		 			$(".image").html("Error"); // Affiche une erreur si c'est égal à 0
		 		else
		 			$(".image").html("<img src='"+response.responseText+"'/>");
		 			// Montre l'image à la fin du chargement
		 	}
		 });
	});
});