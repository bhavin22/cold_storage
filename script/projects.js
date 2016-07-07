var projects = [];
$(document).ready(function(){
	createProjects();
});

function createProjects(){
	if(Storage){
		projects = JSON.parse(localStorage.getItem('projects'));
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
		var $project_container = $(".project_container");
		$project_container.append($(projectsHtml));
		if(length === 0){
			$('.no-projects-to-show').removeClass('hide');
		}
	}
}