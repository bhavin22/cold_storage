var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var passwordRegEx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
var ipRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
var phoneRegEx = /^[789]\d{9}$/;

$('#login').on('click', function(){
	window.location = "/login.php";
});

function validateUserData() {
	var company_name = $('#company_name');
	var user_name = $('#user_name');
	var email = $('#email');
	var ip = $('#ip');
	var password = $('#password');
	var repassword = $('#repassword');
	var address1 = $('#address1');
	var address2 = $('#address2');
	var city = $('#city');
	var country = $('#country');
	var zip_code = $('#zip_code');
	var phone_number = $('#phone_number');

	var error_message = "";

	if(!$.trim($(company_name).val())) {
		$('#error_msg').html("Please enter company name");
		return false;
	} else if(!$.trim($(user_name).val())) {
		$('#error_msg').html("Please enter user name");
		return false;
	} else if(!$(email).val() || !emailRegEx.test($(email).val())) {
		$('#error_msg').html("Please enter valid email adresss");
		return false;
	} else if(!$(ip).val() || !ipRegEx.test($(ip).val())) {
		$('#error_msg').html("Please enter valid ip adresss");
		return false;
	} else if(!$(password).val() || !passwordRegEx.test($(password).val())) {
		$('#error_msg').html("Please enter valid password");
		return false;
	} else if(!$(repassword).val() || $(repassword).val() !== $(password).val()) {
		$('#error_msg').html("Both password should be same");
		return false;
	} else if(!$.trim($(address1).val())) {
		$('#error_msg').html("Please enter address 1");
		return false;
	} else if(!$.trim($(address2).val())) {
		$('#error_msg').html("Please enter address 2");
		return false;
	} else if(!$.trim($(city).val())) {
		$('#error_msg').html("Please enter city");
		return false;
	} else if(!$.trim($(country).val())) {
		$('#error_msg').html("Please enter country");
		return false;
	} else if(!$.trim($(zip_code).val())) {
		$('#error_msg').html("Please enter zip_code");
		return false;
	} else if(!$(phone_number).val() || !phoneRegEx.test($(phone_number).val())) {
		$('#error_msg').html("Please enter valid phone number");
		return false;
	} else {
		return true;
	}
}

function validateLogin() {
	var user_name = $('#user_name');
	var password = $('#password');

	var error_message = "";

	if(!$.trim($(user_name).val())) {
		$('#error_msg').html("Please enter user name");
		return false;
	} else if(!$.trim($(password).val())) {
		$('#error_msg').html("Please enter password");
		return false;
	} else {
		return true;
	}
}

function validateEmail() {
	var email = $('#email');

	var error_message = "";

	if(!$(email).val() || !emailRegEx.test($(email).val())) {
		$('#error_msg').html("Please enter valid email adresss");
		return false;
	} else {
		return true;
	}
}

function validatePasswords() {
	var password = $('#password');
	var repassword = $('#repassword');

	var error_message = "";

	if(!$(password).val() || !passwordRegEx.test($(password).val())) {
		$('#error_msg').html("Please enter valid password");
		return false;
	} else if(!$(repassword).val() || $(repassword).val() !== $(password).val()) {
		$('#error_msg').html("Both password should be same");
		return false;
	} else {
		return true;
	}
}