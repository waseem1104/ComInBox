

function sendMsgServer(idSalon){



var message = document.getElementById('message').value;
	message = message.trim();
	document.getElementById('message').value = null;
	if (message != "") {
		const req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState === 4) {	
				
				displayMsgServer();
			}

		}
	req.open("POST","sendMsgServer.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`message=${message}&idSalon=${idSalon}`);


	}

}



setInterval("displayMsgServer()", 500);

function displayMsgServer(){


const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     		const msg = document.getElementById('msgServer');
      		msg.innerHTML = request.responseText;
    	}
  	}
  request.open('GET', 'displayMsgServer.php');
  request.send();

}
setInterval("displayUsers()", 1000);
