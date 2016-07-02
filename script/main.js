var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var passwordRegEx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
var ipRegEx = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;

$('#login').on('click', function(){
	window.location = "/login.php";
});

$('#video').on('click',function(){
	$('html, body').animate({
        scrollTop: $(".watch-video").offset().top -200
    }, 2000);
})

function validateUserData() {
	var username = $('#username');
	var email = $('#email');
	var password = $('#password');
	var ip = $('#ip');

	var error_message = "";

	if(!$(username).val()) {
		$('#error_msg').html("Please enter username");
		return false;
	} else if(!$(email).val() || !emailRegEx.test($(email).val())) {
		$('#error_msg').html("Please enter valid email adresss");
		return false;
	} else if(!$(password).val() || !passwordRegEx.test($(password).val())) {
		$('#error_msg').html("Please enter valid password");
		return false;
	} else if(!$(ip).val() || !ipRegEx.test($(ip).val())) {
		$('#error_msg').html("Please enter valid ip adresss");
		return false;
	} else {
		return true;
	}
}

function validateLogin() {
	var username = $('#username');
	var password = $('#password');

	var error_message = "";

	if(!$(username).val()) {
		$('#error_msg').html("Please enter username");
		return false;
	} else if(!$(password).val()) {
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
$(document).ready(function(){
	var $project_container = $(".project_container");
	var $projects = createProjects();
	$project_container.append($projects);
});
function createProjects(){
	var length = projects.length;
	var projectsHtml = "";
	for(var i = 0;i<length;i++){
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
	return $(projectsHtml);
}