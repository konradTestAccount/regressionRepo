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