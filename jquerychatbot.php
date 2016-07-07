<!DOCTYPE html>

<html>
<head>
	<!-- 
	<link rel="stylesheet" type="text/css" href="lampuBoboCss.css"> 
	-->
	<script type="text/javascript" src="js/jquery-1.12.1.min.js"> </script>
	<style type="text/css">
		.body {
			margin:0;
			background-color:#f2f2f2;
		}
		#header{
			width:100%;
			height:60px;
			background-color:#333;
			box-shadow: 0px 4px 2px #333;
		}
		#header>h1{
			width:1024px;
			margin:0px auto;
			padding:12px;
			color:white;
		}
		#container{
			width:1024px;
			min-height:500px;
			margin:20px auto 0px auto;
			background-color:white;
			border:1px solid #333;
		}
		#controls{
			width:1024px;
			margin:0px auto;
		}
		textarea{
			resize:none;
			width:900px;
			height: 40px;
		}
		#send{
			position: absolute;
			font-size:24px;
			width: 120px;
			height:45px;
		}
		
		#username {
			color: blue;
			font-weight: bold;
		}
		
		#chatbot {
			color: grey;
			font-weight: bold;
		}
	</style >
</head>
<body>
	
	<script type="text/javascript">
		$(function(){
			
			username();
			
			$("#textbox").keypress(function(event){
				vardump(event.which);
				if( event.which == 13 ) {
					if( $("enter").prop("checked") ){
						$("#send").click();
						event.preventDefault();
					}
			
			});
			
			$("#send").click(function(){
				
				var userMessage = $("#textbox").val();
				$("#textbox").val("");
				$("#container").html(userMessage);
				
				/*
				var username = "You: ";
				var newMessage = $("#textbox").val();
				
				$("#textbox").val("");
				
				var prevState = $("#container").html();
				
				if (prevState.length > 3) {
					prevState = prevstate + " <br>";	
				}
				
				$("#container").html(prevState + newMessage);
				
				$("#container").scrollTop($("#container").prop("scrollHeight"));
				*/
			});
		});
		
		
	</script>
	
	<div id= "header">
			<h1>jQuery Chatbot v. 1.0</h1>
	</div>
	<div id="container">
	
	</div>
	
	<div id="controls">
		<textarea id="textbox" placeholder="Enter your message here..."></textarea>
		<button id="send">Send</button>
		<br>
		<input type="checkbox" id="enter"/>
		<label>Send on Enter</label>
	</div>
</body>

</html>