

function nbUsers(){
 
const req = new XMLHttpRequest();
req.onreadystatechange = function(){

		if (req.readyState === 4) {
			
			document.getElementById('nbUsers').innerHTML = req.responseText;
		}
	}
	req.open("GET","../../pages/nbUsers.php");
	req.send();

}

setInterval("nbUsers()",1000);