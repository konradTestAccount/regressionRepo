$(document).ready(function() {
	$(".include").click(function() {
		include($(this));
	});

	$(".added").click(function() {
		remove($(this));
	});

	$(".selectall").click(function() {
		selectAll($(this));
	});

	$(".removeall").click(function() {
		removeAll($(this));
	});

	$("input[name=submit_lb]").click(function() {
		if(validateEmail($("input[name=email_addr]").val() ) === true) {
			// set the value of the hidden emailVal to the new val, and resubmit the original form
			$("input[type=hidden].emailVal").val($("input[name=email_addr]").val());
			$('.email_error').css('display', 'none');
			$("input[type=hidden].emailVal").parent("form").submit();
		} else {
			$('.email_error').css('display', 'block');
		}
	});

	function validateEmail(email) { 
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    	return re.test(email);
	} 



	function include(selector)
	{
		selector.hide();
		selector.siblings(".added").show();
		selector.siblings(".checkbox").children("input").prop("checked", true);
	}

	function remove(selector)
	{
		selector.hide();
		selector.siblings(".include").show();
		selector.siblings(".checkbox").children("input").prop("checked", false);
		uncheckSelectAll(selector.parents(".accordion-inner").find(".removeall"));
	}

	function selectAll(selector)
	{
		selector.hide();
		selector.siblings(".removeall").show();
		selector.siblings(".checkbox").children("input").prop("checked", true);
		selector.parents(".accordion-inner").children(".row").each(function() {
			include($(this).children(".include"));
		});
	}

	function removeAll(selector)
	{
		selector.hide();
		selector.siblings(".selectall").show();
		selector.siblings(".checkbox").children("input").prop("checked", false);
		selector.parents(".accordion-inner").children(".row").each(function() {
			remove($(this).children(".added"));
		});
	}

	function uncheckSelectAll(selector)
	{
		selector.hide();
		selector.siblings(".selectall").show();
		selector.siblings(".checkbox").children("input").prop("checked", false);
	}
});

				jQuery(document).ready(function(){
  						var error = true;
							jQuery('.lightbox_show').click(function() {
								jQuery.each(jQuery('#prospectus-form .added'), function() {
								
									if(jQuery(this).css('display') == 'block') {
										error = false;
										return;
									}
                    
								});

								if(error === true) {
									alert('Please choose an option');
								} else {
									if(jQuery('#prospectus_lb').length > 0) {
										showLightbox();
									} else {
										return true;
									}
								}

								return false;
							});


							function showLightbox() {
								jQuery.colorbox({inline:true, href:'#prospectus_lb', width:'500px'});
							}
						});
