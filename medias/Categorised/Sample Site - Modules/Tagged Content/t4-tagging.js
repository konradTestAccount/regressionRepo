if ($('[data-t4-tags-url]').length > 0) {
  window.onload = (function(){
    queryString = new Array();

    if (queryString.length == 0) {
      if (window.location.search.split('?').length > 1) {
        var params = window.location.search.split('?')[1].split('&');
        for (var i = 0; i < params.length; i++) {
          var key = params[i].split('=')[0];
          var value = decodeURIComponent(params[i].split('=')[1]);
          queryString[key] = value;
        }
      }
    } 
    loadTags(queryString,'[data-t4-tags-url]');
  });
}

function loadTags(queryString,containerClass) {

  if ($(containerClass).length > 0) {
    var container = $(containerClass);
    console.log(queryString, containerClass,container.data('t4-tags-url'),container.data('t4-tags-error'));
    var output = "";
    var queryVar = 'search';
    if (typeof container.data('t4-tags-variable') !== 'undefined' && container.data('t4-tags-variable') !== '') {
      queryVar = container.data('t4-tags-variable');
    }


    $.getJSON(container.data('t4-tags-url'), function (data) {
      if (queryString[queryVar] != null) {
        var myExp = queryString[queryVar];
        $.each(data, function (key, val) {
          if ((val.tags.search(myExp) != -1)) {
            output += val.html;
          }
        }); //get JSON
      }
      if (output == '') {
        if (typeof container.data('t4-tags-error') !== 'undefined') {
          output = container.data('t4-tags-error');
        } else {
          output = "<p>There are no results matching provided keyword.</p>";
        }
      }
      container.html(output);
      tagsLink();
    });
  } else {
    console.error('Blog Tags: There are no instance of '+ containerClass);
  }
}

function tagsLink() {
  $('[data-t4-url] a').each(function () {
    var baseurl = $(this).parent('[data-t4-url]').data("t4-url");
    var tag = $(this).text();
    $(this).attr("href", baseurl + encodeURI(tag));
  });
}
tagsLink();





