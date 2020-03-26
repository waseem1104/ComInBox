
function unblock(id){


const request = new XMLHttpRequest();
request.open('GET', 'unblock.php?id='+id);

	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
    	
			

    		const bloquer = document.getElementById('bloquer' +id);
    		bloquer.parentNode.removeChild(bloquer);



    	}
  	}
request.send();



}




function blockUser(id){


const req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState === 4) {	
				

				
				const bloquer = document.getElementById('user'+id);
				bloquer.parentNode.removeChild(bloquer);

				displayBlockUser();
			





			}
		}
	req.open("POST","blockUser.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`id=${id}`);


}




setInterval("displayBlockUser()",500);
function displayBlockUser(){




const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
    	
			

    		const bloquer = document.getElementById('bloquer');
    		bloquer.innerHTML = request.responseText;



    	}
  	}
  request.open('GET', 'displayBlockUser.php');
  request.send();



}