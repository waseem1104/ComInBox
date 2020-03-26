function paid(){

	const abo1 = document.getElementById('abo1');
	const value = abo1.getAttribute('value');

	let request = new XMLHttpRequest();
request.onreadystatechange = function(){
	if(request.readyState == 4)
	{
		const response = document.getElementById('response');
		const answer = document.createElement('p');
		if(request.responseText == 1){
		
			answer.innerHTML = "Payement done, thank you and enjoy your premium advantages !";
			
		}else{

			answer.innerHTML = "Wrong values entered or insuffisant money";

		}
		console.log('ok');
		response.appendChild('answer');
		amount.parentNode.appendChild('amount');
	}
}
 request.open("POST", "verifPaiement.php");
 request.setRequestHeader('Content-Type', 'application/x-wwww-form-urlencoded');
 request.send(`value=${value}`);

}

function hidePay() {
	const show = document.getElementById('pay');
	
		show.style.display = 'none';
}

function showPay(){
	const amount = document.getElementById('amount');
	const abo1 = document.getElementById('abo1');
		const value = abo1.getAttribute('value');
		const returned = document.createElement('p');
		returned.innerHTML = "You will pay "+value+" €.";
	    amount.appendChild('returned');

		const show = document.getElementById('pay');
		show.style.display = 'block';
}

