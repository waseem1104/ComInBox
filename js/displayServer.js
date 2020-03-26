
function displayRoom(idServer){

	const request = new XMLHttpRequest();
  	request.onreadystatechange = function() {
    	if(request.readyState === 4) {
     		
    			let data = request.responseText;
    			let room = document.getElementById('room');
    			room.innerHTML = data;

    	}
  	}
  request.open('GET', 'room.php?id=' + idServer);
  request.send();

}


function displayUsersServer(idServer){

  const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
          
          
          let data = request.responseText;
          let room = document.getElementById('members');
          room.innerHTML = data;

      }
    }
  request.open('GET', 'displayUsersServer.php?id=' + idServer);
  request.send();

}



function formCreateRoom(id){



const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {


          const formRoom = document.getElementById('formRoom');
          formRoom.innerHTML = request.responseText;
          
      }
    }
  request.open('GET', 'formCreateRoom.php?id=' + id);
  request.send();



}




function createRoom(id){


const name = document.getElementById('nameRoom').value;
document.getElementById('nameRoom').value = '';

const req = new XMLHttpRequest();
    req.onreadystatechange = function(){
      if (req.readyState === 4) { 
        
        const message = document.getElementById('message');
        message.innerHTML = req.responseText;
        displayRoom(id);



      }
    }
  req.open("POST","createRoom.php");
  req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  req.send(`id=${id}&name=${name}`);





}

function deleteRoom(id){

const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {


   const deleteId = document.getElementById('room' + id);
   deleteId.parentNode.removeChild(deleteId);
      const message = document.getElementById('message');
     message.innerHTML = request.responseText;

      
      



      }
    }
  request.open('GET', 'deleteRoom.php?id=' + id);
  request.send();


}



function infoRoom(id){

const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
      
      
        const infoRoom = document.getElementById('infoRoom');
      infoRoom.innerHTML = request.responseText;


      }
    }
  request.open('GET', 'infoRoom.php?id=' + id);
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
  req.open("POST","modifyRoom.php");
  req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  req.send(`id=${id}&name=${newName}`);



}

function deleteFromServer(idUser,idServer){



const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
      
      

      const deleteFromServer = document.getElementById('user'+ idUser);
      deleteFromServer.parentNode.removeChild(deleteFromServer);
        
        


      }
    }
  request.open('GET', 'deleteFromServer.php?idUser='+idUser+'&idServer='+idServer);
  request.send();


}



function deleteServerFront(id){




const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {

          const server = document.getElementById('server' + id);
          server.parentNode.removeChild(server);

          
          
      }
    }
  request.open('GET', 'deleteServerFront.php?id=' + id);
  request.send();



}

