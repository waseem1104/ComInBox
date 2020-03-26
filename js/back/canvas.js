 function canvas() {

 const month = ['Jan','Fév','Mar','Avr','Mai','Jui','Juil','Août','Sept','Oct','Nov','Déc'];

let request = new XMLHttpRequest();
request.onreadystatechange = function(){
    //getting the values from the database
    let array = request.responseText;
    array = array.split(" ");
  if(request.readyState == 4 && request.status == 200){
        let canvas = document.getElementById('myCanvas');
        let ctx = canvas.getContext('2d');
 
        const width = 40; //bar width
        let x = 50; // first bar position 
       // const base = 200;
         
        for (let i =0; i<array.length-1; i++) {
            ctx.fillStyle = '#008080'; 
            let h = array[i];
            ctx.fillRect(x,canvas.height - h,width,h);
             
            x +=  width+15;
            /* text to display Bar number */
            ctx.fillStyle = '#4da6ff';
            
            ctx.fillText(month[i],x-50,canvas.height - h -10);
            ctx.fillText(array[i],x-50,canvas.height - h -50);
           
        }
        
        }
};  
request.open("GET", "../../pages/canvas.php");
request.send();
}
  