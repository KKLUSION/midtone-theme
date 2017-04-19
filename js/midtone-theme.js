InstantClick.on('change', function(){
    lazyload();
    hljs.initHighlighting();
});

$( document ).ready(function() {
  ajaxComment();
  ajaxCommentPage()
  particleInit();
  setPostImage();
  postToc();
  commentShow();
});

$(window).load(function(){
  console.log('hello');
});

// particle.js settings
var particleInit = function(){
	particlesJS('particles-bg', {
    "particles": {
    "number": {
      "value": 60,
      "density": {
        "enable": true,
        "value_area": 2400
      }
    },
    "color": {
      "value": "#ff5555"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#f0f0ff"
      },
      "polygon": {
        "nb_sides": 4
      },
      "image": {
        "src": "img/github.svg",
        "width": 200,
        "height": 200
      }
    },
    "opacity": {
      "value": 0.5,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 0.1,
        "opacity_min": 0.04,
        "sync": true
      }
    },
    "size": {
      "value": 30,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 10,
        "size_min": 0.5,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 500,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 2
    },
    "move": {
      "enable": true,
      "speed": 1.5,
      "direction": "top",
      "random": true,
      "straight": false,
      "out_mode": "out",
      "bounce": true,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "bubble"
      },
      "onclick": {
        "enable": false,
        "mode": "repulse"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 0.5
        }
      },
      "bubble": {
        "distance": 200,
        "size": 7,
        "duration": 0.89,
        "opacity": 0.8039564401783317,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
}

//post image setting
var setPostImage = function(){
	$("#post-article").find("img").parent().addClass("post-imgbox");
}


var postToc = function(){

	function createLink(href, innerHTML) {
	    var a = document.createElement("a");
	    a.setAttribute("href", href);
	    a.innerHTML = innerHTML;
	    return a;
	}

	function generateTOC(toc) {
	    var i2 = 0, i3 = 0, i4 = 0;

	    var indexdiv = document.createElement("h1");
	    indexdiv.innerHTML = "目录";
	    indexdiv.className = "index-name";
	    toc.appendChild(indexdiv);

	    toc = toc.appendChild(document.createElement("ul"));
	    toc.className = "toclist";

	    var myindex = document.getElementById('post-article').querySelectorAll("h1, h2, h3")
	    for (var i = 0; i < myindex.length; ++i) {
	        var node = myindex[i];
	        // the title of typecho is "h2" element, we should ignore it
	        if( node.className == "index-name"){
	            continue;
	        }
	        var tagName = node.nodeName.toLowerCase();
	        if (tagName == "h3") {
	            ++i4;
	            if (i4 == 1) toc.lastChild.lastChild.lastChild.appendChild(document.createElement("ul"));
	            var section = i2 + "." + i3 + "." + i4;
	            node.id = "section" + section;
	            toc.lastChild.lastChild.lastChild.lastChild.appendChild(document.createElement("li")).appendChild(createLink("#section" + section, node.innerHTML));
	        }
	        else if (tagName == "h2") {
	            ++i3, i4 = 0;
	            if (i3 == 1) toc.lastChild.appendChild(document.createElement("ul"));
	            var section = i2 + "." + i3;
	            node.id = "section" + section;
	            toc.lastChild.lastChild.appendChild(document.createElement("li")).appendChild(createLink("#section" + section, node.innerHTML));
	        }
	        else if (tagName == "h1") {
	            ++i2, i3 = 0, i4 = 0;
	            var section = i2;
	            node.id = "section" + section;
	            toc.appendChild(h2item = document.createElement("li")).appendChild(createLink("#section" + section, node.innerHTML));
	        }
	    }

	    // check if the index is empty
	    indexelements = toc.getElementsByTagName("li");
	    if(indexelements.length == 0){
	        document.getElementById("toc").remove();
	    }
	}

	try
	{
	    generateTOC(document.getElementById('toc'));
	}
	// if anything unexpected happened,we'd rather delete the whole toc than output an incomplete one
	catch(err)
	{
	    var element =  document.getElementById('toc');
	    if (typeof(element) != 'undefined' && element != null)
	    {
	      document.getElementById("toc").remove();
	    }
	}

}


var commentShow = function(){
  $("#comments .comment-cover").on("click", function(){
    $(this).addClass("fadeOut");
    $("#comment-form .comment-inputcontent").addClass("highfree");
    $("#textarea").focus();
    $("#comment-input-secondary").addClass("fadeIn animation-delay");
  });
    $('#comment-main .comment-reply a').on('click', function(){
    $('#comment-main .comment-cover').addClass('fadeOut');
    $('#comment-form .comment-inputcontent').addClass('highfree');
    $('#textarea').focus();
    $('#comment-input-secondary').addClass('fadeIn animation-delay');
  });

}


var ajaxComment = function(){

        $('#comment-input-secondary .comment-submit button').on('click', function(){
             $('.comment-name,.comment-mail,.comment-inputcontent').removeClass('warning');
            if ($('#comment-input-secondary').find('#author')[0]) {
            if ($('.comment-name').find('#author').val() == '') {
                $('.comment-name').addClass('warning');
                warningFocus();
                return false;
            }
            if ($('.comment-mail').find('#mail').val() == '') {
                $('.comment-mail').addClass('warning');
                warningFocus();
                return false;
            }
            var filter = /^[^@\s<&>]+@([a-z0-9]+\.)+[a-z]{2,4}$/i;
            if (!filter.test($('.comment-mail').find('#mail').val())) {
                $('.comment-mail').addClass('warning');
                warningFocus();
                return false;
            }
        }
        if ($('.comment-inputcontent').find('#textarea').val() == '') {
            $('.comment-inputcontent').addClass('warning');
            warningFocus();
            return false;
        }
      });


  $(document).on('submit', '#comment-form', function() {
   $('#comment-input-secondary .comment-submit button').attr('disabled', true);
   $('#loading').removeClass().addClass('fadeIn');
   $.ajax({
     url:  $(this).attr('action'),
     type: $(this).attr('method'),
     data: $(this).serializeArray(),
     error:function(){

       $msg.text('提交失败,请重试!');
       msg_effect('#error');
           return false;
     },
     success: function(data) {
      try {
       if($(data).index("<html>") < 0){
           $('#loading').removeClass().addClass('fadeOut');
           $('#toosoon').removeClass().addClass('fadeIn');
           closeToosoon();
           $('#comment-input-secondary .comment-submit button').removeAttr('disabled');
       }else{
          var data = $(data).find('#comments .comment-list li').first().addClass('fadeIn');
          $('#comments .comment-list').prepend(data);
          $('#loading').removeClass().addClass('fadeOut');
          $('#comment-input-secondary .comment-submit button').removeAttr('disabled');
       }

      } catch (e) {
           console.log('Error!\n\n' + e);

           window.location.reload();
      }
     }
   });
   return false;
  });

  var closeToosoon = function(){
    $('#toosoon').on('click', function(){
      $(this).removeClass().addClass('fadeOut');
    })
  }

  var warningFocus = function(){
    $('#comment-form input,#comment-form textarea').focus(function(){
      $(this).parent('.input-text').removeClass('warning');
    });
  }
}

var ajaxCommentPage = function(){
  var comments = $("#comment-main"),
  loadingText = "loading...",
  ajaxed = false;
  $('#comment-main .page-navigator li a').on("click",function(e) {
    e.preventDefault();
    var _this = $(this),
    _thisP = _this.parent();
    if (_thisP.hasClass('current') || ajaxed == true) return;
    var _list = $('.comment-list'),
    url = _this.attr("href").replace("#comment-main", "") + "?action=ajax_comments";
    $.ajax({
      url: url,
      beforeSend: function() {
        ajaxed = true;
      },
      success: function(data) {
        comments.html(data);
        ajaxed = false;
      }
    });
    return false;
  });
}


var lazyload = function(){
   $("img.lazy").lazyload({
      load : function(){
        $(this).removeClass('lazy').addClass('lazy-loaded');
      }
   });
}
