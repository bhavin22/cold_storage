var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var passwordRegEx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
var ipRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
var phoneRegEx = /^[789]\d{9}$/;
var selectedUserId = [];
var selectedProjectId = [];
var selectedTestimonialId = [];
$('#login').on('click', function(){
	window.location = "/login.php";
});

$(document).ready(function() {
	$('.userCheckbox').on('change', function(evt) {
		if(evt.currentTarget.checked) {
			selectedUserId.push(evt.currentTarget.value);
		} else {
			selectedUserId.splice(selectedUserId.indexOf(evt.currentTarget.value), 1);
		}
		$('#selectedUsers').val(selectedUserId);
	});

	$('.projectCheckbox').on('change', function(evt) {
		if(evt.currentTarget.checked) {
			selectedProjectId.push(evt.currentTarget.value);
		} else {
			selectedProjectId.splice(selectedProjectId.indexOf(evt.currentTarget.value), 1);
		}
		$('#selectedProjects').val(selectedProjectId);
	});

	$('.testimonialCheckbox').on('change', function(evt) {
		if(evt.currentTarget.checked) {
			selectedTestimonialId.push(evt.currentTarget.value);
		} else {
			selectedTestimonialId.splice(selectedTestimonialId.indexOf(evt.currentTarget.value), 1);
		}
		$('#selectedTestimonials').val(selectedTestimonialId);
	});

	$('#editUserList').on('change', function(evt) {
		window.location.href = '/editUserData.php?id=' + evt.currentTarget.value;
	});

	$('#cancelEditing').on('click', function(evt) {
		window.location.href = '/adminDashboard.php';
	});
});


$('#video').on('click',function(){
	$('html, body').animate({
        scrollTop: $(".watch-video").offset().top -200
    }, 2000);
})

function validateUserData() {
	var company_name = $('#company_name');
	var user_name = $('#user_name');
	var email = $('#email');
	var ip = $('#ip');
	var password = $('#password');
	var repassword = $('#repassword');
	var phone_number = $('#phone_number');

	var error_message = "";

	if(!$.trim($(company_name).val())) {
		$('#add_error_msg').html("Please enter company name.");
		return false;
	} else if(!$.trim($(user_name).val())) {
		$('#add_error_msg').html("Please enter user name.");
		return false;
	} else if(!$(email).val() || !emailRegEx.test($(email).val())) {
		$('#add_error_msg').html("Please enter valid email adresss.");
		return false;
	} else if(!$(ip).val() || !ipRegEx.test($(ip).val())) {
		$('#add_error_msg').html("Please enter valid ip adresss.");
		return false;
	} else if(!$(password).val() || !passwordRegEx.test($(password).val())) {
		$('#add_error_msg').html("Please enter valid password.");
		return false;
	} else if(!$(repassword).val() || $(repassword).val() !== $(password).val()) {
		$('#add_error_msg').html("Both password should be same.");
		return false;
	} else if(!$(phone_number).val() || !phoneRegEx.test($(phone_number).val())) {
		$('#add_error_msg').html("Please enter valid phone number.");
		return false;
	} else {
		return true;
	}
}

function validateEditUserData() {
	var company_name = $('#company_name');
	var ip = $('#ip');
	var phone_number = $('#phone_number');

	var error_message = "";

	if(!$.trim($(company_name).val())) {
		$('#error_msg').html("Please enter company name.");
		return false;
	} else if(!$(ip).val() || !ipRegEx.test($(ip).val())) {
		$('#error_msg').html("Please enter valid ip adresss.");
		return false;
	} else if(!$(phone_number).val() || !phoneRegEx.test($(phone_number).val())) {
		$('#error_msg').html("Please enter valid phone number.");
		return false;
	} else {
		return true;
	}
}

function validateDeleteUserData() {
	var selectedUsers = $('#selectedUsers');
	if(!$.trim($(selectedUsers).val())) {
		$('#delete_error_msg').html("Please select users to delete.");
		return false;
	} else {
		return true;
	}
}

function validateDeleteProjectData() {
	var selectedProjects = $('#selectedProjects');
	if(!$.trim($(selectedProjects).val())) {
		$('#delete_project_error_msg').html("Please select projects to delete.");
		return false;
	} else {
		return true;
	}
}

function validateDeleteTestimonialData() {
	var selectedTestimonials = $('#selectedTestimonials');
	if(!$.trim($(selectedTestimonials).val())) {
		$('#delete_testimonial_error_msg').html("Please select testimonials to delete.");
		return false;
	} else {
		return true;
	}
}

function validateTestimonialData() {
	var author = $('#author');
	var company = $('#company');
	var designation = $('#designation');
	var testimonial = $('#testimonial');
	
	var error_message = "";

	if(!$.trim($(author).val())) {
		$('#error_msg').html("Please enter customer name.");
		return false;
	} else if(!$.trim($(company).val())) {
		$('#error_msg').html("Please enter company name.");
		return false;
	} else if(!$.trim($(designation).val())) {
		$('#error_msg').html("Please enter designation.");
		return false;
	} else if(!$.trim($(testimonial).val())) {
		$('#error_msg').html("Please enter testimonial.");
		return false;
	} else {
		return true;
	}
}

function validateProjectData() {
	var project_title = $('#project_title');
	var project_description = $('#project_description');
	var project_image = $('#project_image');
	
	var error_message = "";

	if(!$.trim($(project_title).val())) {
		$('#add_project_error_msg').html("Please enter project title.");
		return false;
	} else if(!$.trim($(project_description).val())) {
		$('#add_project_error_msg').html("Please enter project description.");
		return false;
	} else if(!$(project_image).val()) {
		$('#add_project_error_msg').html("Please select image.");
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
		$('#error_msg').html("Please enter user name.");
		return false;
	} else if(!$.trim($(password).val())) {
		$('#error_msg').html("Please enter password.");
		return false;
	} else {
		return true;
	}
}

function validateEmail() {
	var email = $('#email');

	var error_message = "";

	if(!$(email).val() || !emailRegEx.test($(email).val())) {
		$('#error_msg').html("Please enter valid email adresss.");
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
		$('#error_msg').html("Please enter valid password.");
		return false;
	} else if(!$(repassword).val() || $(repassword).val() !== $(password).val()) {
		$('#error_msg').html("Both password should be same.");
		return false;
	} else {
		return true;
	}
}

$(document).ready(function(){
	attachResizeEvent();
	attachTestSliderEvents();
	setSizeOfTestimonials();
});

var test_slider_width = 230; // With margin
var test_margin = 10;
var slides_in_view = [];
var totalTestimonials = 0;

function attachResizeEvent(){
	$(window).resize(function(event){
		setSizeOfTestimonials();
	});
	totalTestimonials = $('.test_slider_item').length;
}

function setSizeOfTestimonials(){
	var sliderParentWidth = $('.row').width();
	var test_to_display = Math.floor(sliderParentWidth / test_slider_width) || 1;
	var testItemWidth = sliderParentWidth / test_to_display;
	testItemWidth = testItemWidth < test_slider_width ? test_slider_width : testItemWidth;
	var testSliderContainerWidth = testItemWidth  * totalTestimonials;
	var $testSliderContainer = $('.test_slider_wrapper');
	$testSliderContainer.css({'width':testSliderContainerWidth + 'px'});
	$testSliderContainer.find('.test_slider_item').width(testItemWidth - 2 * test_margin);
	slides_in_view = [0,test_to_display - 1];
	setSlideInView(slides_in_view);
}

function setSlideInView(slideRange){
	var $slideContainer = $('.test_slider_wrapper');
	if(slideRange[0] < 0) {
		slideRange[0] += 1;
		slideRange[1] += 1;
		return slideRange;
	}
	if(slideRange[1] >= totalTestimonials){
		slideRange[0] -= 1;
		slideRange[1] -= 1;
		return slideRange;
	}
	var $firstSlide = $($('.test_slider_item')[slideRange[0]]);
	var slideLeft = $firstSlide.offset().left;
	var $slideContainer = $('.test_slider_wrapper');
	var leftToSet = $slideContainer.offset().left - slideLeft + test_margin;
	$slideContainer.css("left",leftToSet + "px");
	return slideRange;
}

function attachTestSliderEvents(){
	var $nextButton = $('.test_next > span');
	var $prevButton = $('.test_previous > span');
	var $scrollDiv = $('.test_slider_wrapper');
	var testWidth = $('.test_slider_item').width();
	$nextButton.on('click',function(event){
		slides_in_view = setSlideInView([slides_in_view[0]+1,slides_in_view[1]+1]);
	});
	$prevButton.on('click',function(event){
		slides_in_view = setSlideInView([slides_in_view[0]-1,slides_in_view[1]-1]);
	})
}