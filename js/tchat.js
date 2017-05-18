var url='tchatAjax.php';
var lastid= 0;
var timer = setInterval(getMessages,1000);
$(function(){
	$("#tchatForm form").submit(function(){
		var message = $("#tchatForm form textarea").val();
		$.post(url,{action:"addMessage",message:message},function(data){
			if (data.erreur=="ok") {
				getMessages();
				$("#tchatForm form textarea").val("");
			}else{
				alert(data.erreur);
			}
		},"json");
		return false;
	})

});

function getMessages(){
	$.post(url,{action:"getMessages",lastid:lastid},function(data){
		if (data.erreur=="ok") {
			$("#tchat").append(data.result);
			lastid=data.lastid;
		}else{
			alert(data.erreur);
		}
	},"json");
	return false;
}