$(document).ready(function(){

    $('.save').each(function(index, value){
        var val = $(this).attr('class').match(/\bcourse-(\d+)\b/);

        if (val != null) {
            course_id = val[1];
            checkIsSaved(course_id);
        }
    });


    if($(".course_compare_accordion .accordion-navigation").length > 0) {
        $(".navigation-left").css("display", "none");
        $(".small-12.medium-9.medium-push-3.columns").addClass("main_content_course_compare");
        $(".main_content_course_compare").removeClass("medium-9").addClass("medium-12");
        $(".main_content_course_compare").removeClass("medium-push-3").addClass("medium-push-12");
    }


    // Remove 'disabled' class on page load if the required number of checkboxes are selected
    if ($('#course_compare_form input[type=checkbox]:checked').length >= 2 && $('#course_compare_form input[type=checkbox]:checked').length <= 3) {
        $('#course_compare_form input').removeClass('disabled');
    }


    $('#course_compare_form input[type=\"checkbox\"]').click(function(event) {
        var checkedBoxes = $('#course_compare_form input[type=checkbox]:checked');
        var uncheckedBoxes = $('#course_compare_form input[type=checkbox]:not(:checked)');
        if (this.checked && checkedBoxes.length > 2) {
            uncheckedBoxes.prop('disabled', true);
            uncheckedBoxes.parent().parent().addClass('disabled');
            if ($('#course_compare_form input[type=\"checkbox\"]').length >= 4) {
                $('.compare_error').css('display', 'block');
            }
        }
        else {
            $('.compare_error').css('display', 'none');
            uncheckedBoxes.prop('disabled', false);
            uncheckedBoxes.parent().parent().removeClass('disabled');
        }

        if (checkedBoxes.length >= 2 && checkedBoxes.length <= 3) {
            $('#course_compare_form input').removeClass('disabled');
        } else {
            if ($('#course_compare_form input').hasClass('disabled') === false) {
                $('#course_compare_form input').addClass('disabled');
            }
        }
    });


$('.course_compare_buttons').unbind('click').on('click', function(e){
    var new_url = '';
    if($(this).children('.showAdd').css('display') == 'block') {
      new_url = $(this).children('.showAdd').children('.save').attr('href');
    } else if($(this).children('.showRemove').css('display') == 'block') {
      new_url = $(this).children('.showRemove').children('.save').attr('href');
    }

    if(new_url != '') {
        window.location = new_url;
    }
});
            
});

function isCourseID(obj) {
    return ((/\bcourse-/).test(obj.className));
}

function checkIsSaved(course) {

    course = parseInt(course);
    //console.log(course);
    course_cookie = getCookie('saved_courses_compare');
    course_cookie = decodeURIComponent(course_cookie);
    if (course_cookie !== '') {
        course_cookie = $.parseJSON(course_cookie);
    }
    
    if(course_cookie[course]) {
        // Show 'remove'
        $('.save.course-' + course).parent('.course_compare_btn.remove').removeClass("hideRemove").addClass("showRemove");
        $('.save.course-' + course).parent('.course_compare_btn.add').removeClass("showAdd").addClass("hideAdd");

    } else {
        // Show 'save'
          $('.course-' + course).parent('.course_compare_btn.add').removeClass("removeAdd").addClass("showAdd");
          $('.course-' + course).parent('.course_compare_btn.remove').removeClass("showRemove").addClass("hideRemove");
    }

}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}


//updated course compare code.
jQuery(document).ready(function() {
  
	jQuery('.course_compare_btn.add a').unbind('click').on('click', function(event) {
		event.preventDefault();
		var buttonContainer = jQuery(this).parent().parent();
		var jqxhr = jQuery.ajax(  {
  method: "GET",
  url: jQuery(this).attr('href'),
  data: { ajax: "on" }
} )
			.done(function() {
				buttonContainer.find('.course_compare_btn.add').toggleClass('hideAdd');
				buttonContainer.find('.course_compare_btn.add').toggleClass('showAdd');
				buttonContainer.find('.course_compare_btn.remove').toggleClass('hideRemove');
				buttonContainer.find('.course_compare_btn.remove').toggleClass('showRemove');
			});
	});
	jQuery('.course_compare_btn.remove a, .course_compare_remove a').unbind('click').on('click', function(event) {
		event.preventDefault();
		var buttonContainer = jQuery(this).parent().parent();
		var jqxhr = jQuery.ajax(  {
  method: "GET",
  url: jQuery(this).attr('href'),
  data: { ajax: "on" }
} )
			.done(function() {
				if(buttonContainer.find('.course_compare_btn').length > 0) {
					buttonContainer.find('.course_compare_btn.add').toggleClass('hideAdd');
					buttonContainer.find('.course_compare_btn.add').toggleClass('showAdd');
					buttonContainer.find('.course_compare_btn.remove').toggleClass('hideRemove');
					buttonContainer.find('.course_compare_btn.remove').toggleClass('showRemove');
				}

				if(jQuery('table.course_compare_saved').length > 0) {
					buttonContainer.remove();
				}
			});
	});
  
});





