$(document).ready(function() {
	
	var emailText = "The Email field must be a valid Email address."
	var passText = "Password must be at least 6 characters long.";
	
	errorSpan = $("#errorSpan");
	errorSpan.hide();
	
	$(".registerbtn").click(function(){
		location.href = "register.html";
	});
	
	$("form").submit(function( event ) {
		email = $("#emailInput").val();
		pass = $("#passInput").val();
		
		if(!checkEmail(email)){
			errorSpan.text(emailText);
			errorSpan.show();
			event.preventDefault();
		}else if(pass.length < 6){
			errorSpan.text(passText);
			errorSpan.show();
			event.preventDefault();
		}
	});
});

function checkEmail(email) {
  var emailReg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return emailReg.test(email);
}