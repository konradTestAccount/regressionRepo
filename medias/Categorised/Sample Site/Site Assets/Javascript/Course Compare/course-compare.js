/*!
 * JavaScript Cookie v2.1.3
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
;(function (factory) {
  var registeredInModuleLoader = false;
  if (typeof define === 'function' && define.amd) {
    define(factory);
    registeredInModuleLoader = true;
  }
  if (typeof exports === 'object') {
    module.exports = factory();
    registeredInModuleLoader = true;
  }
  if (!registeredInModuleLoader) {
    var OldCookies = window.Cookies;
    var api = window.Cookies = factory();
    api.noConflict = function () {
      window.Cookies = OldCookies;
      return api;
    };
  }
}(function () {
  function extend () {
    var i = 0;
    var result = {};
    for (; i < arguments.length; i++) {
      var attributes = arguments[ i ];
      for (var key in attributes) {
        result[key] = attributes[key];
      }
    }
    return result;
  }

  function init (converter) {
    function api (key, value, attributes) {
      var result;
      if (typeof document === 'undefined') {
        return;
      }

      // Write

      if (arguments.length > 1) {
        attributes = extend({
          path: '/'
        }, api.defaults, attributes);

        if (typeof attributes.expires === 'number') {
          var expires = new Date();
          expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
          attributes.expires = expires;
        }

        try {
          result = JSON.stringify(value);
          if (/^[\{\[]/.test(result)) {
            value = result;
          }
        } catch (e) {}

        if (!converter.write) {
          value = encodeURIComponent(String(value))
            .replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
        } else {
          value = converter.write(value, key);
        }

        key = encodeURIComponent(String(key));
        key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
        key = key.replace(/[\(\)]/g, escape);

        return (document.cookie = [
          key, '=', value,
          attributes.expires ? '; expires=' + attributes.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
          attributes.path ? '; path=' + attributes.path : '',
          attributes.domain ? '; domain=' + attributes.domain : '',
          attributes.secure ? '; secure' : ''
        ].join(''));
      }

      // Read

      if (!key) {
        result = {};
      }

      // To prevent the for loop in the first place assign an empty array
      // in case there are no cookies at all. Also prevents odd result when
      // calling "get()"
      var cookies = document.cookie ? document.cookie.split('; ') : [];
      var rdecode = /(%[0-9A-Z]{2})+/g;
      var i = 0;

      for (; i < cookies.length; i++) {
        var parts = cookies[i].split('=');
        var cookie = parts.slice(1).join('=');

        if (cookie.charAt(0) === '"') {
          cookie = cookie.slice(1, -1);
        }

        try {
          var name = parts[0].replace(rdecode, decodeURIComponent);
          cookie = converter.read ?
            converter.read(cookie, name) : converter(cookie, name) ||
            cookie.replace(rdecode, decodeURIComponent);

          if (this.json) {
            try {
              cookie = JSON.parse(cookie);
            } catch (e) {}
          }

          if (key === name) {
            result = cookie;
            break;
          }

          if (!key) {
            result[name] = cookie;
          }
        } catch (e) {}
      }

      return result;
    }

    api.set = api;
    api.get = function (key) {
      return api.call(api, key);
    };
    api.getJSON = function () {
      return api.apply({
        json: true
      }, [].slice.call(arguments));
    };
    api.defaults = {};

    api.remove = function (key, attributes) {
      api(key, '', extend(attributes, {
        expires: -1
      }));
    };

    api.withConverter = init;

    return api;
  }

  return init(function () {});
}));



function isCourseID(obj) {
    return ((/\bcourse-/).test(obj.className));
}

                                                                                                              
function checkIsSaved(course) {

    course = parseInt(course);
    //console.log(course);
  var cookieCourses = Cookies.getJSON("saved_courses_compare");
    if (typeof cookieCourses === 'undefined') {
          var cookieCourses = [];
 		 }
     
      
                                                           

    // start course count to show at top of page
    
    if(course in cookieCourses) {
                                                            
        // Show 'remove'
        $('.save.course-' + course).parent('.course_compare_btn.remove').removeClass("hideRemove").addClass("showRemove");
        $('.save.course-' + course).parent('.course_compare_btn.add').removeClass("showAdd").addClass("hideAdd");
                                                               
                                                                                                                          
    } else  {
         // Show 'save'
          $('.course-' + course).parent('.course_compare_btn.add').removeClass("hideAdd").addClass("showAdd");
          $('.course-' + course).parent('.course_compare_btn.remove').removeClass("showRemove").addClass("hideRemove");

    }
	 

}

function removeLastComma(strng){        
    var n=strng.lastIndexOf(",");
    var a=strng.substring(0,n) ;
    var b=strng.substring(n+1) ;
    return a+b;
}

function getLength(obj) {
  var count = 0;
  var i;

  for (i in obj) {
    if (obj.hasOwnProperty(i)) {
        count++;
    }
  }

  return count;
}


function checkCourses(){
    ajaxUrl = "<t4 type='navigation' id='57'/>/index.json"; 
    
    if(jQuery('table.course_compare_saved').length > 0) {
      jQuery('table.course_compare_saved').find('tr.compare_row').remove();
    }
    
    var jqxhr = jQuery.ajax(
        {
          method: "GET",
          dataType: 'text',
          url: ajaxUrl,
          success: function(json) {
              json = removeLastComma(json);
              if (json !== '') {
                json = JSON.parse(json);                                               
              }
              var existingCourses = {};
              var courseInfo = {};
              for (var i = 0, len = json.courses.length; i < len; i++) {
                existingCourses[json.courses[i].contentID] = json.courses[i].contentID;
                courseInfo[json.courses[i].contentID] = json.courses[i];
              }

              var cookieCourses = Cookies.getJSON("saved_courses_compare");
            
            if (typeof cookieCourses === 'undefined') {
          var cookieCourses = [];
 		 }

              var newCookie = {};
              jQuery.each(cookieCourses,function( i ){
                if (existingCourses[cookieCourses[i]] == cookieCourses[i] && cookieCourses[i] !== null) {
                    key = cookieCourses[i].toString();
                    newCookie[key] = cookieCourses[i];

                    if(jQuery('table.course_compare_saved').length > 0) {
                      var html;
                      var courseURLBefore = '<label for="course-' + cookieCourses[i] + '" >';
                      var courseURLAfter = '</label>';
                      if (courseInfo[cookieCourses[i]].courseURL) {
                        courseURLBefore += '<a href="'+courseInfo[cookieCourses[i]].courseURL+'" class="rd">';
                        courseURLAfter += "</a>";
                      }
                      console.log(courseInfo[cookieCourses[i]].courseURL);
                      html = '<tr class="compare_row">';
                      html += '<td>' + courseURLBefore + courseInfo[cookieCourses[i]].courseName + courseURLAfter + '</td>';
                      html += '<td class="small_col_centered"><label for="course-' + cookieCourses[i] + '" ><span class="saved_coures_code">' + courseInfo[cookieCourses[i]].courseCode + '</span></label></td>';
                      html += '<td class="small_col_centered"><input type="checkbox" id="course-' + cookieCourses[i] + '" name="compare_course[]" value="' + cookieCourses[i] + '"></td>';
                      html += '<td class="small_col_centered course_compare_remove"><a href="?removeCourse=' + cookieCourses[i] + '" class="course-' + cookieCourses[i] + '"><span class="fa fa-times"></span></a></td>';
                      html += '</tr>';
                      console.log(courseInfo[cookieCourses[i]]);
                      jQuery('table.course_compare_saved tr:last').after(html);
                    }
                  }
              });
        jQuery('.courses_loader').hide();
              if((getLength(cookieCourses) - 1) != getLength(newCookie)) {
                  Cookies.set("saved_courses_compare", newCookie, { expires: null, path: '/' });
              }

              return newCookie;

          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
                } 
          });
}

function viewSavedCourses() {

        var cookieCourses = Cookies.getJSON("saved_courses_compare");
  
  if (typeof cookieCourses === 'undefined') {
          var cookieCourses = [];
 		 }
     

        updateSavedCourses = getLength(cookieCourses);

        if(updateSavedCourses <=0){
            updateSavedCourses = 0;
            jQuery('.totalCourses').hide();
            jQuery('body .page header .totalCourses').text("" );
        }else{
              jQuery('.totalCourses').show();
              jQuery('body .page header .totalCourses').text("( "+updateSavedCourses+" )" );
        }
          
            
}





jQuery(document).ready(function() {

  checkCourses();
  viewSavedCourses();

  /**
    * Save and remove course buttons for Course Compare
      *
    ***/
  jQuery('.results').on('click', '.course_compare_btn.add, .course_compare_btn.remove', function(event) {
    event.preventDefault();

    var buttonContainer = jQuery(this).parent();

    var aObj = jQuery(this);

    var val = aObj.find('.save').attr('class').match(/\bcourse-(\d+)\b/);
    if (val != null) {
      course_id = val[1];
      // start course count to show at top of page
      course_id = parseInt(course_id);

      var cookieCourses = Cookies.getJSON("saved_courses_compare");
      
      if (typeof cookieCourses === 'undefined') {
          var cookieCourses = [];
 		 }
     

      if(course_id in cookieCourses) {
        delete cookieCourses[course_id];
      } else {
          cookieCourses[course_id] = course_id;
      }

      console.log(cookieCourses);
      //set new cookie
      Cookies.set("saved_courses_compare", cookieCourses, { expires: null, path: '/' });

      checkIsSaved(course_id);

      }

    viewSavedCourses();

    // end course count
    if(jQuery('table.course_compare_saved').length > 0) {
      buttonContainer.remove();
    }

  });
  
  jQuery('.course_compare_saved').on('click', '.course_compare_remove a', function(event) {
    event.preventDefault();

    var buttonContainer = jQuery(this).parent();

    var aObj = jQuery(this);

    var val = aObj.attr('class').match(/\bcourse-(\d+)\b/);

    console.log(val);

    if (val != null) {
      course_id = val[1];
      // start course count to show at top of page
      course_id = parseInt(course_id);

      var cookieCourses = Cookies.getJSON("saved_courses_compare");
      
      if (typeof cookieCourses === 'undefined') {
          var cookieCourses = [];
 		 }

      if(course_id in cookieCourses) {
        delete cookieCourses[course_id];
      }

      console.log(cookieCourses);
      //set new cookie
      Cookies.set("saved_courses_compare", cookieCourses, { expires: null, path: '/' });

      aObj.closest('tr').remove();

      }

    viewSavedCourses();

    // end course count
    if(jQuery('table.course_compare_saved').length > 0) {
      buttonContainer.remove();
    }

  });

    /**
      * course compare page
      *
      * display and hide compared content sections
      *
    ***/
    jQuery('.collapse-all').on('click', function(event) {
        event.preventDefault();
      
      jQuery(this).toggleClass('hidden');
      jQuery('.expand-all').toggleClass('hidden');
      
        jQuery('.course_compare_accordion .accordion-navigation').removeClass('active');
        jQuery('.course_compare_accordion .content').removeClass('active');
    });
    jQuery('.expand-all').on('click', function(event) {
        event.preventDefault();
      
      jQuery(this).toggleClass('hidden');
      jQuery('.collapse-all').toggleClass('hidden');
      
        jQuery('.course_compare_accordion .accordion-navigation').removeClass('active');
        jQuery('.course_compare_accordion .content').removeClass('active');
      
        jQuery('.course_compare_accordion .accordion-navigation').addClass('active');
        jQuery('.course_compare_accordion .content').addClass('active');
    });
  

   $('.save').each(function(index, value){
        var val = $(this).attr('class').match(/\bcourse-(\d+)\b/);

        if (val != null) {
            course_id = val[1];
            checkIsSaved(course_id);

        }

    });

    //Accordion in compare page
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


    jQuery('table.course_compare_saved').on('click', 'input[type=\"checkbox\"]', function(event) {
        console.log(jQuery('#course_compare_form input[type=checkbox]:checked').length);
        var checkedBoxes = jQuery('#course_compare_form input[type=checkbox]:checked');
        var uncheckedBoxes = jQuery('#course_compare_form input[type=checkbox]:not(:checked)');
        if (this.checked && checkedBoxes.length > 2) {
            uncheckedBoxes.prop('disabled', true);
            uncheckedBoxes.parent().parent().addClass('disabled');
            if (jQuery('#course_compare_form input[type=\"checkbox\"]').length >= 4) {
                jQuery('.compare_error').css('display', 'block');
            }
        }
        else {
            jQuery('.compare_error').css('display', 'none');
            uncheckedBoxes.prop('disabled', false);
            uncheckedBoxes.parent().parent().removeClass('disabled');
        }

        if (checkedBoxes.length >= 2 && checkedBoxes.length <= 3) {
            jQuery('#course_compare_form input').removeClass('disabled');
        } else {
            if (jQuery('#course_compare_form input').hasClass('disabled') === false) {
                jQuery('#course_compare_form input').addClass('disabled');
            }
        }
    });
        


});







