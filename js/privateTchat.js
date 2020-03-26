

function sendMsg(receveur){

	var message = document.getElementById('message').value;
	message = message.trim();
	document.getElementById('message').value = '';
	if (message != "") {
		const req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState === 4) {	
				display();
			}
		}
	req.open("POST","sendMsg.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`message=${message}&receveur=${receveur}`);

	}	
}


function display(){

	const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     		const msg = document.getElementById('msg');
      		msg.innerHTML = request.responseText;	
    	}
  	}
  request.open('GET', 'see.php');
  request.send();
}


setInterval("display()", 500);



// PAS EFFACER
//document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight; 