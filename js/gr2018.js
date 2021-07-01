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

    // ------------------------------------------------------------------------------- //
    // GR2018 - BEAM TEXT ON CANVAS
    // ------------------------------------------------------------------------------- //
    var locationString = $('#header-verkiezing .verkiezing-location .locality').html();
    var verkiezingString = $('#header-verkiezing .verkiezing-name').html();
    var sloganString = $('#header-verkiezing .verkiezing-slogan').html();

    // Load the canvas as soon as the font is available
    var reqFont = new FontFaceObserver('HelveticaInseratLTPro');
    reqFont.load().then(function () {
      renderTextOnCanvas('header-verkiezing-rendered',locationString,verkiezingString,sloganString);
      $('#header-verkiezing').hide();
      $('body').addClass('canvas');

      // After that on window resize
      window.onresize = function(event) {
        renderTextOnCanvas('header-verkiezing-rendered',locationString,verkiezingString,sloganString);
      };

    }, function () {
      // console.log('Font is not available');
    });

    // ------------------------------------------------------------------------------- //

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
    $("a[href='#top']").click(function(e){
      e.preventDefault();
      $("html, body").animate({ scrollTop: $("#primary-verkiezing").offset().top }, "slow");
    });
  });
})(jQuery);


function renderTextOnCanvas(target,locationString,verkiezingString,sloganString) {
  var canvas = document.getElementById(target);
  var ctx = canvas.getContext('2d');
  paintLayers(canvas,ctx,locationString,verkiezingString,sloganString);
}

function paintLayers(canvas,ctx,locationString,verkiezingString,sloganString) {

  locationString = locationString.toUpperCase();
  sloganString = sloganString.toUpperCase();
  verkiezingString =verkiezingString.toUpperCase();

  if(sloganString.indexOf("VOOR ELKAAR") !== -1) {
    locationString = "VOOR "+locationString;
  }

  var color1 = '#ec1b23'; // SP Red
  var color2 = '#ffe300'; // Warm yellow
  var color3 = '#ffffff'; // Bright white

  canvas.width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
  canvas.height =  canvas.width;
  canvas.heightTaken = 0;
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  var widthCenter = canvas.width / 2;

  // Responsiveness rules
  var fontHeight = 24;
  var lineSpacing = 24;
  var strokeWidth = 4;
  if(canvas.width > 480) {
    fontHeight = 48;
    strokeWidth = 6;
  }
  if(canvas.width > 768) {
    fontHeight = 62;
    strokeWidth = 9;
  }
  
  // HEADER NEED WORK
  drawBeamText(ctx,canvas, verkiezingString, color1,color2,1,1,fontHeight * 0.5);
  drawBeamText(ctx,canvas, sloganString, color3, color1,1,1, fontHeight);
  drawBeamText(ctx,canvas, locationString, color1, color2,-1,0.66, fontHeight * 2);

  var primary = document.getElementById("primary-verkiezing");
  primary.setAttribute("style", "padding-top: "+canvas.heightTaken+"px");
}

function drawBeamText(ctx,canvas,string,colorFill,colorStroke,transX,transY,minFont) {

   string = string.toUpperCase();

   var iterations = canvas.width;
   var fontHeight = minFont;
   var fontName = 'HelveticaInseratLTPro';

   if (string == 'icon-tomato') {
       fontName = 'SPruit-icons';
       string = 'T';
   }

   // Resize to fit
   ctx.font = fontHeight + 'px ' + fontName;
   var textWidth = ctx.measureText(string).width;
   
   // Responsiveness
   var maxDrawWidth =  canvas.width - 64;
   var strokeWidth = 4;
   
   if (canvas.width > 1080) {
     maxDrawWidth = 1080;
   }
   if(canvas.width > 480) {
     strokeWidth = 6;
   }
   if(canvas.width > 768) {
     strokeWidth = 9;
   }

   while (textWidth > maxDrawWidth) {
       fontHeight--;
       ctx.font = fontHeight + 'px ' + fontName;
       textWidth = ctx.measureText(string).width;
   }

   // Create an offscreen canvas with text dimensions
   var imgc = document.createElement('canvas');
   imgc.width = textWidth + strokeWidth * 1.5;
   imgc.height = fontHeight + strokeWidth * 1.5 ;
   var ctxOff = imgc.getContext('2d');

   // Paint once
   ctxOff.textAlign = 'start';
   ctxOff.textBaseline = 'top';
   ctxOff.strokeStyle = colorStroke;
   ctxOff.lineWidth = strokeWidth;
   ctxOff.font = ctx.font;
   ctxOff.strokeText(string,strokeWidth,strokeWidth);

   // Paint many for the beam starting from first available line
   var curWidth = imgc.width;
   var curHeight = imgc.height;
   var ratio = curWidth / curHeight;
   var scale = 0.2;
   var startX = (canvas.width / 2) - (textWidth / 2);

   startY = canvas.heightTaken;
   canvas.heightTaken += fontHeight + 6;

   for (var i = 0; i < iterations; i++) {
       curWidth -= scale;
       curHeight -= scale / ratio;
       if (curHeight < 0) {
         curHeight = 0;
       }
       if (curWidth < 0) {
         curHeight = 0;
       }
       ctx.drawImage(imgc, startX + (transX * i), startY + (transY * i), curWidth, curHeight);
   }
   // Cap
   ctx.textAlign = 'start';
   ctx.textBaseline = 'top';
   ctx.fillStyle = colorFill;
   ctx.fillText(string, strokeWidth + startX, startY + strokeWidth);

}

