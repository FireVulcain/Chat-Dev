var url='tchatAjax.php';
var lastid= 0;
var codeHTML = 0;
var codeCSS = 0;
var codeJS = 0;
var codePHP = 0;
var codeG = 0;
var moitie = 0;
setInterval(getMessages,2000);
setTimeout(function(){
	$('.loader').fadeOut();
}, 3000);
// Test les messages envoyés pour voir si c'est du code ou non
function testCode(){
	var message = $('textarea#message').val();
	tableau = [];
	tableau = message.split('\n');
	console.log(tableau);
	for (var i = 0 ; i < tableau.length ; i++) {
		console.log("I"+[i]+" : "+tableau[i]);
		//Code Général\\
		if (tableau[i].substr(-1, 1) == ";") {
			codeG = codeG + 1
		}
		for (var j = 0 ; j < tableau[i].length ; j++) {
			// console.log("J"+[j]+" : "+tableau[i][j]);
			//********************Code HTML********************\\
			if (tableau[i][j].indexOf('<head>') >= 0 || tableau[i][j].indexOf('<body>') >= 0 || 
				tableau[i][j].indexOf('<p>') >= 0  || tableau[i][j].indexOf('<div') >= 0) {
				codeHTML = codeHTML + 5;
			}
			if (tableau[i][j].indexOf('<img') >= 0 || tableau[i][j].indexOf('<a') >= 0) {
				codeHTML = codeHTML + 5;
			}
			if (tableau[i][j].indexOf('>') >= 0 || tableau[i][j].indexOf('</') >= 0 
				|| tableau[i][j].indexOf('/>') >= 0) {
				codeHTML = codeHTML + 4;
			}
			if (tableau[i][j].indexOf('id=') >= 0 || tableau[i][j].indexOf('class=') >= 0 
				|| tableau[i][j].indexOf('src=') >= 0 || tableau[i][j].indexOf('href=') >= 0) {
				codeHTML = codeHTML + 3;
			}
			//********************Code CSS********************\\
			if (tableau[i][j].indexOf('{') >= 0 || tableau[i][j].indexOf('}') >= 0) {
				codeCSS = codeCSS + 2;
			}
			if (tableau[i][j].indexOf(';') >= 0  || tableau[i][j].indexOf('#') >= 0) {
				codeCSS = codeCSS + 1.5;
			}
			if (tableau[i][j].indexOf('margin') >= 0 || tableau[i][j].indexOf('padding') >= 0 
				|| tableau[i][j].indexOf('width') >= 0 || tableau[i][j].indexOf('height') >= 0 
				|| tableau[i][j].indexOf('color') >= 0) {
				codeCSS = codeCSS + 1;
			}
			//********************Code Javascript********************\\
			if (tableau[i][j].indexOf('{') >= 0 || tableau[i][j].indexOf('}') >= 0) {
				codeJS = codeJS + 3;
			}
			if (tableau[i][j].indexOf(';') >= 0) {
				codeJS = codeJS + 2;
			}
			if (tableau[i][j].indexOf('||') >= 0 || tableau[i][j].indexOf('&&') >= 0) {
				codeJS = codeJS + 1.5;
			}
			if (tableau[i][j].indexOf('(') >= 0 || tableau[i][j].indexOf(')') >= 0) {
				codeJS = codeJS + 0.5;
			}
			//********************Code PHP********************\\
			if (tableau[i][j].indexOf('<?php') >= 0 || tableau[i][j].indexOf('?>') >= 0) {
				codePHP = codePHP + 4;
			}
			if (tableau[i][j].indexOf('$_') >= 0 || tableau[i][j].indexOf('echo') >= 0) {
				codePHP = codePHP + 2;
			}
			if (tableau[i][j].indexOf('||') >= 0 || tableau[i][j].indexOf('&&') >= 0) {
				codePHP = codePHP + 1.5;
			}
			if (tableau[i][j].indexOf('$') >= 0) {
				codePHP = codePHP + 1;
			}
			if (tableau[i][j].indexOf('(') >= 0 || tableau[i][j].indexOf(')') >= 0) {
				codePHP = codePHP + 0.5;
			}
		}
	}
	moitie = (tableau.length);
	console.log("Code HTML : " + codeHTML);
	console.log("Code CSS : " + codeCSS);
	console.log("Code JS : " + codeJS);
	console.log("Code PHP : " + codePHP);
	console.log("codeG : " + codeG);
}

$(function(){
	$("#tchatForm form").on('keypress', (function(e){
		if(e.which == 13 && !e.shiftKey && $.trim($("textarea").val())) {
			testCode();
			var message = $("#tchatForm form textarea").val();
			var type = (codeHTML >= 5 || codeCSS >= 4 ||  codeJS >= 6 || codePHP >= 6 || codeG >= (moitie)) ? 'code' : 'message';
			$.post(url,{action:"addMessage",message:message, type:type},function(data){
				if (data.erreur=="ok") {
					getMessages();
					$("#tchatForm form textarea").val("");
				}else{
					alert(data.erreur);
				}	
			},"json");
			codeHTML = 0;
			codeCSS = 0;
			codeJS = 0;
			codePHP = 0;
			codeG = 0;
			moitie = 0;
			return false;
		}
	}));
});


function getMessages(){
	$.post(url,{action:"getMessages",lastid:lastid},function(data){
		if (data.erreur=="ok") {
				for (var k = 0; k < data.result.length ; k++) {
					$("#tchat").append(data.result[k]);
					if(data.result[k].indexOf('download.php?id') >=0){
						$(".fichier").append(data.result[k]);
					}
				}
				lastid=data.lastid;
		}else{
			alert(data.erreur);
		}
	},"json");
	return false;
}