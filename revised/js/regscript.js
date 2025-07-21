// let form = document.forms['register'];

document.forms['register'].onsubmit = function(event){

	let errors = document.querySelectorAll(".error");
	for(let error of errors){
		error.style.display = "none";
	}
	document.querySelector(".success").innerHTML = "";


	if(this.username.value.trim() === ""){
		document.querySelector(".username-error").innerHTML = "Please enter a username";
		document.querySelector(".username-error").style.display = "block";
		event.preventDefault();
		return false;
	}
    if(this.email.value.trim() === ""){
		document.querySelector(".email-error").innerHTML = "Please enter a email";
		document.querySelector(".email-error").style.display = "block";
		event.preventDefault();
		return false;
	}

	if(this.password.value.trim() === ""){
		document.querySelector(".password-error").innerHTML = "Please enter a password";
		document.querySelector(".password-error").style.display = "block";
		event.preventDefault();
		return false;
	}
   
    if(this.re_pass.value.trim() === ""){
		document.querySelector(".re_pass-error").innerHTML = "Please reenter your password";
		document.querySelector(".re_pass-error").style.display = "block";
		event.preventDefault();
		return false;
	}

    if(this.contact.value.trim() === ""){
		document.querySelector(".contact-error").innerHTML = "Please enter your phone number";
		document.querySelector(".contact-error").style.display = "block";
		event.preventDefault();
		return false;
	}

	if(this.agreeterm.value.trim() === ""){
		document.querySelector(".agreeterm-error").innerHTML = "Please accept the Terms of Services";
		document.querySelector(".agreeterm-error").style.display = "block";
		event.preventDefault();
		return false;
	}

}