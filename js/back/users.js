
setInterval("displayUsers()", 1000);
function displayUsers(){

const search = document.getElementById('searchUser').value;

const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     			
     			const users = document.getElementById('users');
     			users.innerHTML = request.responseText;
     			
    	}
  	}
  request.open('GET', '../../pages/displayUsersBack.php?search=' + search);
  request.send();

}







function deleteUser(){



	const id = document.getElementById('id').innerHTML;
	const req = new XMLHttpRequest();
	req.onreadystatechange = function(){

		if (req.readyState === 4) {
			

			const message = document.getElementById('messageSuccess');
			message.innerHTML = req.responseText;
			userInfo(id);
			
		}
	}
	req.open("POST","../../pages/delete.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`id=${id}`);
}



function displayFriendsBack(id){



const request = new XMLHttpRequest();
request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     			
     			const friends = document.getElementById('friends');
     			friends.innerHTML = request.responseText;
     			
    	}
  	}
  request.open('GET', '../../pages/displayFriendsBack.php?id=' +id);
  request.send();

}



function userInfo(id){



const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {

     			const userInfo = document.getElementById('userInfo');
     			userInfo.innerHTML = request.responseText;	
     			
    	}
  	}
  request.open('GET', '../../pages/userInfo.php?id=' + id);
  request.send();



}


function modifyUser(){

const id = document.getElementById('id').innerHTML;
 const lastname = document.getElementById('lastname').value;
 const firstname = document.getElementById('firstname').value;
 const email = document.getElementById('email').value;

	const req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState === 4) {	
				const message = document.getElementById('messageSuccess');
				message.innerHTML = req.responseText;
				userInfo(id);
			}
		}
	req.open("POST","../../pages/modifyUserBack.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`id=${id}&lastname=${lastname}&firstname=${firstname}&email=${email}`);




}
