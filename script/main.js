var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var passwordRegEx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
var ipRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
var phoneRegEx = /^[789]\d{9}$/;
var selectedId = [];
$('#login').on('click', function(){
	window.location = "/login.php";
});

$(document).ready(function() {
	$('.userCheckbox').on('change', function(evt) {
		if(evt.currentTarget.checked) {
			selectedId.push(evt.currentTarget.value);
		} else {
			selectedId.splice(selectedId.indexOf(evt.currentTarget.value), 1);
		}
		$('.userId').val(selectedId);
	});
});


$('#video').on('click',function(){
	$('html, body').animate({
        scrollTop: $(".watch-video").offset().top -200
    }, 500);
})

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

var projects = [{
		image:'./images/projects/1.jpg',
		title:'Project 1',
		description:'THis is it.'
	},
	{
	image:'./images/projects/2.jpg',
	title:'Project 2',
	description:'THis is it.'
},
{
	image:'./images/projects/3.jpg',
	title:'Project 3',
	description:'THis is it.'
},
{
	image:'./images/projects/4.jpg',
	title:'Project 4',
	description:'THis is it.'
},
{
	image:'./images/projects/5.jpg',
	title:'Project 5',
	description:'THis is it.'
},
{
	image:'./images/projects/6.jpg',
	title:'Project 6',
	description:'THis is it.'
},{
	image:'./images/projects/7.jpg',
	title:'Project 7',
	description:'THis is it.'
}];

var testimonials = [{
	author:'John Doe',
	company:'First Steps Co.',
	testimonial:'“Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.”1',
	designation:'CEO'
},{
	author:'John Doe',
	company:'First Steps Co.',
	testimonial:'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.2',
	designation:'CEO'
},{
	author:'John Doe',
	company:'First Steps Co.',
	testimonial:'“Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.”3',
	designation:'CEO'
},{
	author:'John Doe',
	company:'First Steps Co.',
	testimonial:'“Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."4',
	designation:'CEO'
},{
	author:'John Doe',
	company:'First Steps Co.',
	testimonial:'“Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."5',
	designation:'CEO'
},{
	author:'John Doe',
	company:'First Steps Co.',
	testimonial:'“Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."6',
	designation:'CEO'
}];

$(document).ready(function(){
	createProjects();
	createTestimonials();
	attachResizeEvent();
	attachTestSliderEvents();
});

var projects_to_show = 3;
function createProjects(){
	var length = projects.length;
	var projectsHtml = "";
	for(var i = 0;i<projects_to_show;i++){
		projectsHtml += '<div class="col-md-4 col-sm-6 col-xxs-12">\n\
					<a href="' + projects[i].image + '" class="fh5co-project-item image-popup to-animate">\n\
						<img src="' + projects[i].image + '" alt="Image" class="project_image img-responsive">\n\
						<div class="fh5co-text">\n\
						<h2>' + projects[i].title + '</h2>\n\
						<span>' + projects[i].description + '</span>\n\
						</div>\n\
					</a>\n\
				</div>';
	}
	var $project_container = $(".project_container");
	$project_container.append($(projectsHtml));
	if(length > projects_to_show && Storage){
		$('.more_link').removeClass('hide');
		localStorage.setItem('projects',JSON.stringify(projects));
	}

}

var test_slider_width = 230; // With margin
var test_margin = 10;
var slides_in_view = [];

function createTestimonials(){
	var totalTestimonials = testimonials.length;
	var $testSliderContainer = $('.test_slider_wrapper');
	var testHtml = "";
	for(var i = 0;i<totalTestimonials;i++){
		testHtml += '<div class="test_slider_item">\n\
						<div class="box-testimony">\n\
							<blockquote class="to-animate-2">\n\
								<p>&ldquo;' + testimonials[i].testimonial + '&rdquo;</p>\n\
							</blockquote>\n\
							<div class="author to-animate">\n\
								<figure><img src="images/person1.jpg" alt="Person"></figure>\n\
								<p>' + testimonials[i].author + ', ' + testimonials[i].designation + '<span class="subtext">'+testimonials[i].company + '</span>\n\
								</p>\n\
							</div>\n\
						</div>\n\
					</div>';
	}
	var $testimonials = $(testHtml);
	$testSliderContainer.append($testimonials);
	setSizeOfTestimonials();
}

function attachResizeEvent(){
	$(window).resize(function(event){
		setSizeOfTestimonials();
	});
}

function setSizeOfTestimonials(){
	var sliderParentWidth = $('.row').width();
	var test_to_display = Math.floor(sliderParentWidth / test_slider_width) || 1;
	var totalTestimonials = testimonials.length;
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
	var totalSlides = testimonials.length;
	if(slideRange[0] < 0) {
		slideRange[0] += 1;
		slideRange[1] += 1;
		return slideRange;
	}
	if(slideRange[1] >= totalSlides){
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