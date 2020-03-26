


setInterval("displayServersBack()", 1000);
function displayServersBack(){


const search = document.getElementById('searchServer').value;

const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     			
     			const servers = document.getElementById('servers');
     			servers.innerHTML = request.responseText;
     			
    	}
  	}
  request.open('GET', '../../pages/displayServersBack.php?search=' + search);
  request.send();

}

function adminServerBack(id){



const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {

         
        const admin = document.getElementById('admin');
        admin.innerHTML = request.responseText;
          
          
      }
    }
  request.open('GET', '../../pages/adminServerBack.php?id=' + id);
  request.send();


}



function members(id){



const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {

         
        const members = document.getElementById('members');
        members.innerHTML = request.responseText;
          
          
      }
    }
  request.open('GET', '../../pages/membersServerBack.php?id=' + id);
  request.send();


}


function deleteServerBack(id){




const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {

          const server = document.getElementById('server' + id);
          server.parentNode.removeChild(server);
          displayRoomBack(id);
          const info = document.getElementById('info');
          info.parentNode.removeChild(info);
          const admin = document.getElementById('admin' + id);
          admin.parentNode.removeChild(admin);

          
          
      }
    }
  request.open('GET', '../../pages/deleteServerBack.php?id=' + id);
  request.send();



}

function modifyServer(id){

const name = document.getElementById('name').value;



		const req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState === 4) {	
				

				
				const message = document.getElementById('message');
				message.innerHTML = req.responseText;	
				infoServer(id);

	

			}
		}
	req.open("POST","../../pages/modifyServer.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`id=${id}&name=${name}`);



}


function infoRoom(id){

const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
    	
			
    		const infoRoom = document.getElementById('infoRoom');
			infoRoom.innerHTML = request.responseText;


    	}
  	}
  request.open('GET', '../../pages/infoRoom.php?id=' + id);
  request.send();

}

function infoServer(id){


const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
    	
			
    		const infoServer = document.getElementById('infoServer');
			infoServer.innerHTML = request.responseText;


    	}
  	}
  request.open('GET', '../../pages/infoServer.php?id=' + id);
  request.send();



}


function displayRoomBack(idServer){

	const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     		
    			let data = request.responseText;
    			let room = document.getElementById('room');
    			room.innerHTML = data;

    	}
  	}
  request.open('GET', '../../pages/displayRoomBack.php?id=' + idServer);
  request.send();

}



function modifyRoom(id){

	const newName = document.getElementById('newName').value;



		const req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState === 4) {	
				

				


					if (req.responseText > 0) {
						const idServer = req.responseText;
						displayRoomBack(idServer);
						displayRoom(idServer);


					}else{


						const message = document.getElementById('message');
						message.innerHTML = req.responseText;

					}
				infoRoom(id);
			


				



			}
		}
	req.open("POST","../../pages/modifyRoom.php");
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.send(`id=${id}&name=${newName}`);



}