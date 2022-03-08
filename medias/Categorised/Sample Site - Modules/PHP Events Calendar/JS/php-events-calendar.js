
function runAjax(link,loadArea,reloadLoadArea) {
  var loadAreaID  = loadArea.prop('id');
  var contentID   = loadArea.data("ajaxloadalso");
  if (reloadLoadArea == true) {
    loadArea.css('opacity',0.5);

  }
  if (contentID != undefined ) {
    for (i = 0; i < contentID.length; ++i) {
          $("#"+contentID[i]).css('opacity',0.5);
    }
  }
  $.ajax({
    url: link,
    context: document.body
  }).done(function( data) {
    if (reloadLoadArea == true) {
      loadArea.html($(data).find("#"+loadAreaID).html()).css('opacity',1);
    }

    if (contentID != undefined ) {
      for (i = 0; i < contentID.length; ++i) {
        $("#"+contentID[i]).html($(data).find("#"+contentID[i]).html()).css('opacity',1);
      }
    }
    categories_trigger();
  });

}

$(".ajax-load-area").on("click",".ajax-load-link a,a.ajax-load-link",function(event){
  if(($('#calendar_events').length || $('#calendar_page').length) && $(this).prop('id') != 'searchoptions') {
    console.log($('#calendar_events').length);
    event.preventDefault();
    var link = $(this).attr("href");
    var loadArea = $(this).parents('.ajax-load-area')

    runAjax(link,loadArea,true);

  }
});

$("#jumptoform").on('click',"input[type=submit]",function(event){
     if($('#calendar_events').length || $('#calendar_page').length) {
    event.preventDefault();
    var link = $("#jumptoform form").attr("action")+"?"+$("#jumptoform form").serialize();
    var loadArea = $("#jumptoform");

    runAjax(link,loadArea,false);
  }
});

$("#searchoptions").on('click',"form :checkbox",function(event){
    if($('#calendar_events').length || $('#calendar_page').length) {
    var link = $("#searchoptions form").attr("action")+"?"+$("#searchoptions form").serialize();
    var loadArea = $("#searchoptions");

    runAjax(link,loadArea,false);
  }
});
$("#searchoptions-generic").on('click',"form :checkbox",function(event){
    if($('#calendar_events').length || $('#calendar_page').length) {
    var link = $("#searchoptions-generic form").attr("action")+"?"+$("#searchoptions-generic form").serialize();
    var loadArea = $("#searchoptions-generic");

    runAjax(link,loadArea,false);
  }
});
$("#searchoptions-categories").on('click',"form :checkbox",function(event){
    if($('#calendar_events').length || $('#calendar_page').length) {
    var link = $("#searchoptions-categories form").attr("action")+"?"+$("#searchoptions-categories form").serialize();
    var loadArea = $("#searchoptions-categories");

    runAjax(link,loadArea,false);
  }
});

$("#past_events").on('click',"form :checkbox",function(event){
    if($('#calendar_events').length || $('#calendar_page').length) {
    var link = $("#past_events form").attr("action")+"?"+$("#past_events form").serialize();
    var loadArea = $("#past_events");

    runAjax(link,loadArea,false);
  }
});


var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$("#searchoptions").on('keyup',"input[type=text]",function(event){
     if($('#calendar_events').length || $('#calendar_page').length) {
    delay(function(){
      event.preventDefault();

      var link = $("#searchoptions form").attr("action")+"?"+$("#searchoptions form").serialize();
      var loadArea = $("#searchoptions");

      runAjax(link,loadArea,false);

    }, 500 );
  }
});

$('#searchoptions form').bind("keypress", function(e) {
  if (e.keyCode == 13) {
    e.preventDefault();
    return false;
  }
});

$("#searchoptions-generic").on('keyup',"input[type=text]",function(event){
     if($('#calendar_events').length || $('#calendar_page').length) {
    delay(function(){
      event.preventDefault();

      var link = $("#searchoptions-generic form").attr("action")+"?"+$("#searchoptions-generic form").serialize();
      var loadArea = $("#searchoptions-generic");

      runAjax(link,loadArea,false);

    }, 500 );
  }
});

$('#searchoptions-generic form').bind("keypress", function(e) {
  if (e.keyCode == 13) {
    e.preventDefault();
    return false;
  }
});



$("#calendar_page").on('mouseenter mouseleave'," .cal-event a",function(event){
    $(this).removeAttr("title");
    event.preventDefault();
    var contentID = $(this).data("tooltipcal");
    $("#" + contentID).toggleClass("active");
});

function categories_trigger(){
  $('.ajax-load-area .categories_trigger a').each(function(){
    var baseurl = $(this).parent('.categories_trigger').data("baseurl");
    var catname = $(this).text();
    caturl = catname.replace(/ /gi,"+");
    caturl = caturl.replace(/&/gi,"%26");


    $(this).attr("href",baseurl+"&categories[]="+caturl);
    $(this).data("catname",catname);
    var sub = catname.split(">");
    if (sub[1] != "") {
      $(this).html(sub[1]);
    }
  });
}
categories_trigger();
