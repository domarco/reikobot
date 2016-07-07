<!DOCTYPE html>

<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/ChatInterface.css"> 
	
	<script type="text/javascript" src="js/jquery-1.12.1.min.js"> </script>
	<script type="text/javascript" src="js/script.js"> </script>
	<style>
		#display {
			height: 250px;
			width: 250px;
			border: 1px solid grey;
		}
	</style>
</head>
<body>
	
	<div id= "header">
			<h1>Reiko Chatbot v. 1.2</h1>
	</div>
	<div id="chatbox">
	
	</div>
	
	<div id="controls">
		<textarea id="textbox" placeholder="Enter your message here..."></textarea>
		<button id="send">Send</button>
		<br>
		<input checked type="checkbox" id="enter"/>
		<label>Send on Enter</label>
	</div>
</body>

</html>