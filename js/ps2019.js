(function($) {
  var getScrollBarWidth = function getScrollBarWidth () {
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";

    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild (inner);

    document.body.appendChild (outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) {
      w2 = outer.clientWidth;
    }

    document.body.removeChild (outer);

    return (w1 - w2);
  };

  /**
   * Checks if jquery element is in view
   */
  function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }

  function setInternalLinks(scrollbarWidth) {
    afdelingen3.closeModal($('.modal:visible'), false);
    // When anchor is set, show corresponding content.
    if (location.hash.indexOf('#tab-') === 0) {
      window.scrollTo(0, 0);
      // Show correct tab when tab anchor.
      $('.nav-tabs li.active').removeClass('active');
      $('a[href="' + location.hash  + '"]').parent().addClass('active');
      $('.content-tab:visible').hide();
      $(location.hash).show();
    }
    else if (location.hash.indexOf('#node_') === 0) {
      $('.nieuws-titels li').removeClass('active');
      $('.nieuws-item').hide();
      // Show overzicht tab.
      $('a[href="#tab-overzicht"]').parent().addClass('active');
      $('#tab-overzicht').show();
      // Show correct article.
      afdelingen3.openModal($(location.hash), scrollbarWidth, false);
    }
    else if (location.hash.indexOf('#chapter-') === 0) {
      $('.nav-chapters li').removeClass('active');
      $('.chapter').hide();
      // Show programma tab.
      $('a[href="#tab-programma"]').parent().addClass('active');
      $('#tab-programma').show();
      // Show correct chapter.
      $(location.hash).show();
      $('a[href="' + location.hash  + '"]').parent().addClass('active');
      $("html, body").animate({ scrollTop: $(location.hash).offset().top - 200 }, 0);
    }
    else if (location.hash.indexOf('#kandidaat-') === 0 ) {
      $('.nav-tabs li.active').removeClass('active');
      $('.content-tab:visible').hide();
      // Chapter navigation
      $('#tab-kandidaten').show();
      $('.nav-chapters li.active').removeClass('active');
      $('.chapter:visible').hide();
      afdelingen3.openModal($(location.hash), scrollbarWidth, false);
    }
    else {
      // Defaults.
      $('.content-tab:visible').hide();
      $('#tab-overzicht').show();
    }
  }

  function getAnchorFromLink(e) {
    e.preventDefault();

    var url = $(e.currentTarget).attr('href');
    return {
      url: url,
      anchor: typeof url !== 'undefined' ? url.substring(url.indexOf("#")+1) : ""
    };
  }

  $(document).ready(function(){
    var myLazyLoad = new LazyLoad({
      elements_selector: "img, iframe"
    });

    // Default hide.
    $('.content-tab').hide();
    $('.nieuws-titels li').removeClass('active');
    $('.nieuws-item').hide();
    $('.nav-chapters li').removeClass('active');
    $('.chapter').hide();
    $('.achtergrond-item').hide();
    $('#to-top').hide();

    // Default show.
    $('.chapter').first().show();

    // Show / hide to-top button.
    if ($(this).scrollTop() > $(window).height() ){
      $('#to-top').show();
    }

    $(window).scroll(function() {
      if ($(this).scrollTop() > $(window).height() ){
        $('#to-top').show();
      }
      else if ($(this).scrollTop() < $(window).height() ){
        $('#to-top').hide();
      }
    });



    // Show / hide volgons.
    $('#volgons').hide();
    $(window).scroll(function() {
      if ($(this).scrollTop() > 300){
        $('#volgons').fadeIn(200);
      }
      else {
        $('#volgons').fadeOut(200);
      }
    });


    // Set scrollbar width as extra padding for modal
    var scrollbarWidth = getScrollBarWidth();
    setInternalLinks(scrollbarWidth);
    window.addEventListener('popstate', function(e){
      setInternalLinks(scrollbarWidth);
    });
    // process link clicks.
    $('.nav-tabs li a').click(function(e) {
      var anchor_and_url = getAnchorFromLink(e);
      var anchor = anchor_and_url.anchor;
      $('.nav-tabs li.active').removeClass('active');
      $('.content-tab:visible').hide();
      // content tab display
      $('#'+anchor).show();
      $('a[href="#'+anchor+'"]').parent().addClass('active');
      window.history.pushState("tab", "",anchor_and_url.url);
      $("html, body").animate({ scrollTop: 0 }, "fast");
    });

    $('.nieuws-titel a').click(function(e){
      var anchor = getAnchorFromLink(e).anchor;

      $('.nav-tabs li.active').removeClass('active');
      $('.content-tab:visible').hide();
      // nieuws tabs display
      $('#tab-overzicht').show();
      $('.nieuws-titels li.active').removeClass('active');
      $('.nieuws-item:visible').hide();
      afdelingen3.openModal($('#'+anchor), scrollbarWidth, true);
    });
    $('.nav-chapters a').click(function(e){
      var anchor_and_url = getAnchorFromLink(e);
      var anchor = anchor_and_url.anchor;
      $('.nav-tabs li.active').removeClass('active');
      $('.content-tab:visible').hide();
      // Chapter navigation
      $('#tab-programma').show();
      $('.nav-chapters li.active').removeClass('active');
      $('.chapter:visible').hide();
      $('#'+anchor).show();
      $('a[href="#'+anchor+'"]').parent().addClass('active');
      window.history.pushState("chapter", "",anchor_and_url.url);
      if (!isScrolledIntoView($('#'+anchor))) {
        $("html, body").animate({ scrollTop: $('#'+anchor).offset().top - 30 }, "slow");
      }
    });
    $('.kandidaat-link').click(function(e){
      var anchor = getAnchorFromLink(e).anchor;
      $('.nav-tabs li.active').removeClass('active');
      $('.content-tab:visible').hide();
      // Chapter navigation
      $('#tab-kandidaten').show();
      $('.nav-chapters li.active').removeClass('active');
      $('.chapter:visible').hide();
      afdelingen3.openModal($('#' + anchor), scrollbarWidth, true);
    });
    // #to-top - scroll to top on click
    $("a[href='#header-verkiezing']").click(function(e){
      e.preventDefault();

      //$("html, body").animate({ scrollTop: $("#primary-verkiezing").offset().top }, "slow");
      $("html, body").animate({ scrollTop: "0px" }, "slow");
    });
  });
})(jQuery);

