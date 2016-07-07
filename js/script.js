var username = "";
		
function bot_message(message) {
	
	var prevState = $("#chatbox").html();
		
	if (prevState.length > 3) {
		prevState = prevState + "<br>";
	}
	
	//$("#chatbox").html(prevState + "<span class = 'chatbot'> Chatbot: </span>" + message);
	
	$("#chatbox").html( prevState + "<span class='current_message'>" + "<span class = 'chatbot'> Chatbot: </span>" + message + "</span>");
	$(".current_message").hide();
	$(".current_message").delay(500).fadeIn();
	$(".current_message").removeClass("current_message");
			
}

function get_username(){
	bot_message("Hello, What is your name?");
}

$(function() {
	
	get_username();
	
	$("#textbox").keypress(function(event) {
		if ( event.which == 13) {
			if ( $("#enter").prop("checked") ) {
				$("#send").click();
				event.preventDefault();
			}
		}
	});

	$("#send").click(function() {
		var username = "<span class='username' = > You: </span>";
		var newMessage = $("#textbox").val();
		
		$("#textbox").val("");
		
		var prevState = $("#chatbox").html();
		
		if (prevState.length > 3) {
			prevState = prevState + "<br>";
		}
		
		$("#chatbox").html(prevState + username + newMessage);
		
		$("#chatbox").scrollTop($("#chatbox").prop("scrollHeight"));
		
		newMessage = newMessage.toUpperCase();
		
		$.ajax({ 
			type: "POST",
			url: "nlp_process.php",
			data: { 'userMessage' : newMessage},
			//dataType:'json',
			success: function(output) {
				 bot_message(output);
				 alert(output);
              },
			error: function(request, status, error){
				alert("Error: Could not parse parse");
			}
		});
		//window.location.href = "getValue.php";
		//ai(newMessage);
	});	

}); // end of Function

function showUser(str) {
    if (str == "") {
        document.getElementById("textbox").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("textbox").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","currentphpversion.php?q="+str,true);
        xmlhttp.send();
    }
}

function ai(message) {
	if (username.length < 3) {
		username = message;
		bot_message("Nice to meet you " + username + ", how are you doing?");
	}
	
	if (message.indexOf("HOW ARE YOU")>=0){
		bot_message("Thanks, I am good!");
	}
	
	if (message.indexOf("TIME")>=0){
		var date = new Date();
		var h = date.getHours();
		var m = date.getMinutes();
		
		bot_message("Current time is : " + h + ":" + m);
	}
}
