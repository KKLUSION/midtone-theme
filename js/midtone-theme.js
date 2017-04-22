InstantClick.on('change', function(){
    lazyload();
     var blocks = document.querySelectorAll('pre code');
      for (var i = 0; i < blocks.length; i++) {
        hljs.highlightBlock(blocks[i]);
      }
     defaultStyle();
});

$(document).ready(function() {
  hello();
  postListStyle();
  moblieMenu();
  searchBar();
  totopHelper();
  titleFading();
  hljs.initHighlighting();
  ajaxComment();
  ajaxCommentPage()
  particleInit();
  setPostImage();
  postToc();
  menublock();
  commentShow();
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
          var toc = document.getElementById("toc");
	        toc.parentNode.removeChild(toc);
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
    $('#pagenavi .next a').hover(function(){
      $('.page-next-link').toggleClass('page-link-loaded');
    });
    $('#pagenavi .prev a').hover(function(){
      $('.page-prev-link').toggleClass('page-link-loaded');
    });
}


var ajaxComment = function(){
  $('#comment-input-secondary .comment-submit button').on('click',function(){
    $('#comment-input-secondary .comment-submit button').attr('disabled', true);
       $('.comment-name,.comment-mail,.comment-inputcontent').removeClass('warning');
    if ($('#comment-input-secondary').find('#author')[0]) {
        if ($('.comment-name').find('#author').val() == '') {
            $('.comment-name').addClass('warning');
            warningFocus();
            enableBtn();
            return false;
        }
        if ($('.comment-mail').find('#mail').val() == '') {
            $('.comment-mail').addClass('warning');
            warningFocus();
            enableBtn();
            return false;
        }
        var filter = /^[^@\s<&>]+@([a-z0-9]+\.)+[a-z]{2,4}$/i;
        if (!filter.test($('.comment-mail').find('#mail').val())) {
            $('.comment-mail').addClass('warning');
            warningFocus();
            enableBtn();
            return false;
        }
        enableBtn();
    }
    if ($('.comment-inputcontent').find('#textarea').val() == '') {
        $('.comment-inputcontent').addClass('warning');
        warningFocus();
        enableBtn();
        return false;
    }
  });

  $('#comment-form').submit(function() {
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
           enableBtn();
       }else{
          var data = $(data).find('#comments .comment-list li').first().addClass('fadeIn');
          $('#comments .comment-list').prepend(data);
          $('#loading').removeClass().addClass('fadeOut');
          enableBtn();
       }

      } catch (e) {
           console.log('Error!\n\n' + e);

           window.location.reload();
      }
     }
   });
   return false;
  });

  var enableBtn = function(){
    $('#comment-input-secondary .comment-submit button').removeAttr('disabled');
  }

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


var menublock = function(){
  var $t, leftX, newWidth;
  $('#nav-menu').append('<span class="block"></span>');
  var $block = $('.block');
  var hasCurrent = $('#nav-menu').has('.current').length;
  var cal = function(){
      if(hasCurrent){
      $block.width($("#nav-menu .current").width()).css('left', $('#nav-menu .current a').position().left).data('rightLeft', $block.position().left).data('rightWidth', $block.width());
      $('#nav-menu li').find('a').hover(function() {
        $t = $(this);
        leftX = $t.position().left;
        newWidth = $t.parent().width();
        $block.stop().animate({
          left: leftX,
          width: newWidth
        },400);
      }, function() {
        $block.stop().animate({
          left: $block.data('rightLeft'),
          width: $block.data('rightWidth')
        },400)
      });
  }else{
    return false;
  }
  }
  $(window).resize(function(){
      cal();
    });
  cal();
}


var postListStyle = function(){
  $('#post-style .post-style-lines').on('click', function(){
    $(this).addClass('currentstyle').siblings().removeClass('currentstyle');
    $('.post-article').parent().removeClass().addClass('midtone-post col-12 col-md-12');
    var style = 'midtone-post col-12 col-md-12';
    var iscurrent = false;
    localStorage.setItem("list_style",style);
    localStorage.setItem("list_current",iscurrent);
  });
  $('#post-style .post-style-cubes').on('click', function(){
    $(this).addClass('currentstyle').siblings().removeClass('currentstyle');
    $('.post-article').parent().removeClass().addClass('post-cube col-4 col-mb-6');
    var style = 'post-cube col-4 col-mb-6';
    var iscurrent = true;
    localStorage.setItem("list_style",style);
    localStorage.setItem("list_current",iscurrent);
  });

}

var defaultStyle = function(){
  var nowstyle = localStorage.getItem("list_style");
  var nowCurrent = localStorage.getItem("list_current");
  if(nowstyle){
    $('.post-article').parent().removeClass().addClass(nowstyle);
  }else{
    return false;
  }
  if(nowCurrent == 'true'){
    $('#post-style .post-style-cubes').addClass('currentstyle').siblings().removeClass('currentstyle');
  }else{
    $('#post-style .post-style-lines').addClass('currentstyle').siblings().removeClass('currentstyle');
  }
}


var titleFading = function(){

  var fadeStart=15
      ,fadeUntil=250
      ,fading = $('#fading')
      ,helper = $('#totop');

$(window).bind('scroll', function(){
    var offset = $(document).scrollTop()
        ,opacity=0
    ;
    if( offset<=fadeStart ){
        opacity=1;
    }else if( offset<=fadeUntil ){
        opacity=1-offset/fadeUntil;
    }
    fading.css('opacity',opacity);
    if( offset>=300 ){
      helper.removeClass().addClass('fadeIn');
    }else{
      helper.removeClass().addClass('fadeOut')
    }
    });
}


var totopHelper = function(){
  $('#totop .totop-btn').on('click', function(){
     $('body,html').animate({scrollTop:0},600);
  });
  $('#totop .article-qr').hover(function(){
     $('.article-qrbody').toggleClass('fadeIn');
  });
}


var searchBar = function(){
  $('#search-bar a').on('click', function(){
     $('#site-search').removeClass().addClass('fadeIn');
     $('#site-search input').focus();
  });
  $('#site-search .search-close').on('click', function(){
    $('#site-search').removeClass().addClass('fadeOut');
    $('#mb-navigation .button-toggle-navigation,.mb-nav-menu').removeClass('isActive').removeClass('slideDown');
  })
}

var moblieMenu = function(){
  $('#mb-navigation .button-toggle-navigation').on('click', function() {
    $(this).toggleClass('isActive');
    $('.mb-nav-menu').toggleClass('slideDown');
  });
}

var hello = function(){
  $(document).keydown(function() {
    if(event.keyCode==123){
     console.clear();
     console.log('theme design and code with <3 by mizodo.');
     console.log('for more infomation click https://blog.mizodo.com');
  }else{
  }
  });
}