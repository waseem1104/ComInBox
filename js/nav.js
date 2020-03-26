

// $("#burger").click(function(){

//   $("#navigation").slideToggle();

// });


function burger(){


	let navigation = document.getElementById('navigation');

	if (navigation.style.display == 'none') {

		navigation.style.display = 'block';

	}else{

			navigation.style.display = 'none';

	}


}