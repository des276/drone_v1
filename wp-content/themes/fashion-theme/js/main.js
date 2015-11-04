jQuery(window).trigger('resize').trigger('scroll');

var doc = document.documentElement; doc.setAttribute('data-useragent', navigator.userAgent);

;(function ($) {
"use strict";

/* Parallax */
$(window).stellar();

var jPM = $.jPanelMenu({
    menu: '#site-navigation',
    trigger: '.mobile-menu a',
    animated: false
});

var jRes = jRespond([
    {
        label: 'small',
        enter: 0,
        exit: 768
    },{
        label: 'medium',
        enter: 768,
        exit: 980
    },{
        label: 'large',
        enter: 980,
        exit: 10000
    }
]);

jRes.addFunc({
    breakpoint: 'small',
    enter: function() {
        jPM.on();

        $('li.account-dropdown').clone().removeClass('hide-for-small').appendTo($('#jPanelMenu-menu'));
        $('.html-block-inner').clone().removeClass('hide-for-small').appendTo($('#jPanelMenu-menu')).wrap('<li></li>');

        $('ul.top-bar-nav').clone().removeClass('hide-for-small').appendTo($('#jPanelMenu-menu')).wrap( "<li class='top-bar-items'></li>" );

        $('.header-wrapper .search-wrapper').clone().removeClass('hide-for-small').prependTo($('#jPanelMenu-menu')).wrap('<li></li>');

        $('.menu-parent-item > .nav-top-link').click(function(e){
          $(this).parent().toggleClass('open');
          e.preventDefault();
        });
    },
    exit: function() {
        jPM.off();
    }
});



/* GRID LIST SWITCH */
$(".productGrid").click(function(){
  $(".productGrid").addClass("active");
  $(".productList").removeClass("active");
  $.cookie('gridcookie','grid', {path: '/'});
  $("ul.products").fadeOut(300,function(){
      $(this).addClass('grid large-block-grid-3').removeClass('list large-block-grid-1').fadeIn(300);
  });

  return false;
});


$(".productList").click(function(){
  $(".products").attr('class','products list small-block-grid-2 large-block-grid-1');
  $(".productList").addClass("active");
  $(".productGrid").removeClass("active");
  $.cookie('gridcookie','list', {path: '/'});
  $("ul.products").fadeOut(300,function(){
      $(this).addClass('list large-block-grid-1').removeClass('grid large-block-grid-3').fadeIn(300);
  });
  return false;
});

if ($.cookie('gridcookie')){
  $("ul.products").addClass($.cookie('gridcookie'));
}

if ($.cookie('gridcookie') == 'grid') {
  $(".filter-tabs .productGrid").addClass('active');
  $(".filter-tabs .productList").removeClass('active');
}

if($.cookie('gridcookie') == 'list') {
  $(".filter-tabs .productList").addClass('active');
  $(".filter-tabs .productGrid").removeClass('active');
}

$(".filter-tabs li").click(function(event){
  event.preventDefault();
});


$('.quick-view').click(function(e){
  
   $(this).parent().parent().after('<div class="please-wait dark"><i></i><i></i><i></i><i></i></div>');
   var product_id = $(this).attr('data-prod');
   var data = { action: 'jck_quickview', product: product_id};
    $.post(ajaxurl, data, function(response) {
     $.magnificPopup.open({
        mainClass: 'my-mfp-zoom-in',
        items: {
          src: '<div class="product-lightbox">'+response+'</div>',
          type: 'inline'
        }
      });
     $('.please-wait,.color-overlay').remove();

     setTimeout(function() {
        $('.main-image-slider-1').owlCarousel({
            navigation : true,
            slideSpeed : 300,
            pagination: false,
            paginationSpeed : 500,
            autoPlay : true,
            stopOnHover : false,
            itemsCustom : [
            [0, 1],
            [450, 1],
            [600, 1],
            [700, 1],
            [1000, 1],
            [1200, 1],
            [1400, 1],
            [1600, 1]
            ],
            navigationText: ["", ""]
        });
        $('.product-lightbox form').wc_variation_form();
        $('.product-lightbox form select').change();
      }, 600);
    });
    

    e.preventDefault();
});

jRes.addFunc({
    breakpoint: ['large','medium'],
    enter: function() {

        $('.nav-top-link').parent().hoverIntent(
            function () {
                 var max_width = '1200';
                 if(max_width > $(window).width()) {max_width = $(window).width()}
                 $(this).find('.nav-dropdown').css('max-width',max_width);
                 $(this).addClass('active');
                 var dropdown_width = $(this).find('.nav-dropdown').outerWidth();
                 var col_width =  $(this).find('.nav-dropdown > ul > li.menu-parent-item').width();
                 var cols = ($(this).find('.nav-dropdown > ul > li.menu-parent-item').length);
                 cols += ($(this).find('.nav-dropdown > ul > li.image-column').length);
                 var col_must_width = cols*col_width;
                 if($('.wide-nav').hasClass('nav-center')){
                  $(this).find('.nav-dropdown').css('margin-left','-70px');
                }

                 if(col_must_width >= dropdown_width){
                    $(this).find('.nav-dropdown').width(col_must_width);
                    $(this).find('.nav-dropdown').addClass('no-arrow');
                    //$(this).find('.nav-dropdown').css('left','auto');
                    $(this).find('ul:after').remove();
                 }
            },
            function () {
                  $(this).removeClass('active');
            }
        );

         $('.menu-item-language-current').hoverIntent(
            function () {
                 $(this).find('.sub-menu').fadeIn(50);

            },
            function () {
                 $(this).find('.sub-menu').fadeOut(50);
            }
        );
        

         $('.search-dropdown').hoverIntent(
            function () {
                 if($('.wide-nav').hasClass('nav-center')){
                    $(this).find('.nav-dropdown').css('margin-left','-85px');
                  }
                 $(this).find('.nav-dropdown').fadeIn(50);
                 $(this).addClass('active');
                 $(this).find('input').focus();

            },
            function () {
                 $(this).find('.nav-dropdown').fadeOut(50);
                 $(this).removeClass('active');
                 $(this).find('input').blur();
            }
        );

        $('.category-tree').hoverIntent(
          function(){
            $(this).find('.nav-dropdown').fadeIn(50);
            $(this).addClass('active');
          },
          function(){
            $(this).find('nav-dropdown').fadeOut(50);
            $(this).removeClass('active');
          }
        );

        $('.category-tree .nav-dropdown ul > li').click(function(){
          var selected = jQuery.trim($(this).text());
          var maxLengh = 8;
          console.log($(this).html());
          //$('.category-tree > .category-inner span').html(selected);
          $('.category-tree > .category-inner span').html(selected).text(function(i, text){
            if(text.length > maxLengh){
              return text.substr(0, maxLengh) + '...';
            }
          });
          
        });

         $('.cart-link').parent().parent().hoverIntent(
            function () {
                 $(this).find('.nav-dropdown').fadeIn(50);
                 $(this).addClass('active');

            },
            function () {
                 $(this).find('.nav-dropdown').fadeOut(50);
                 $(this).removeClass('active');
            }
          );
    },
    exit: function() {
    }
});


  $('.product-lightbox-btn').magnificPopup({
      // delegate: 'a',
      type: 'image',
      tLoading: '<div class="please-wait dark"><i></i><i></i><i></i><i></i></div>',
      mainClass: 'my-mfp-zoom-in product-zoom-lightbox',
      removalDelay: 300,
      closeOnContentClick: true,
      gallery: {
          enabled: true,
           navigateByImgClick: false,
          preload: [0,1] 
      },
      image: {
          verticalFit: false,
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
      }
  });

  $("*[id^='attachment'] a, .entry-content a[href$='.jpg'], .entry-content a[href$='.jpeg']").magnificPopup({
    type: 'image',
    tLoading: '<div class="please-wait dark"><i></i><i></i><i></i><i></i></div>',
    closeOnContentClick: true,
    mainClass: 'my-mfp-zoom-in',
    image: {
      verticalFit: false
    }
  });


  $(".gallery a[href$='.jpg'],.gallery a[href$='.jpeg'],.featured-item a[href$='.jpeg'],.featured-item a[href$='.gif'],.featured-item a[href$='.jpg'], .page-featured-item .slider > a, .page-featured-item .page-inner a > img, .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']").parent().magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: '<div class="please-wait dark"><i></i><i></i><i></i><i></i></div>',
    mainClass: 'my-mfp-zoom-in',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] 
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
    }
  });


$('#main-content').waypoint(function() {
  $('#top-link').toggleClass('active');
},{offset:'-100%'});


// **********************************************************************// 
// ! Fixed header
// **********************************************************************// 
    
$(window).scroll(function(){
    if (!$('body').find('fixNav-enabled')) {return false; }
    var fixedHeader = $('.fixed-header-area');
    var scrollTop = $(this).scrollTop();
    var headerHeight = $('.header-wrapper').height() + 50;
    
    if(scrollTop > headerHeight){
        if(!fixedHeader.hasClass('fixed-already')) {
            fixedHeader.stop().addClass('fixed-already');
        }
    }else{
        if(fixedHeader.hasClass('fixed-already')) {
            fixedHeader.stop().removeClass('fixed-already');
        }
    }
});




$('#top-link').click(function(e) {
    $.scrollTo(0,300);
    e.preventDefault();
}); // top link


$('.scroll-to').each(function(){
    var link = $(this).data('link');
    var end = $(this).offset().top;
    var title = $(this).data('title');

    if($(this).data('bullet','true')){
      $('.scroll-to-bullets').append('<a href="'+link+'"><strong>'+title+'</strong><span></span></a><br/>');
    }

    $('a[href="'+link+'"]').click(function(){
        $.scrollTo(end,500);
    });

    $(this).waypoint(function() {
      $('.scroll-to-bullets a').removeClass('active');
      $('.scroll-to-bullets').find('a[href="'+link+'"]').toggleClass('active');
    },{offset:'0'});
});

$('.scroll-to-reviews').click(function(e){

    $('.product-details .tabs-nav li').removeClass('current-menu-item');
    $('.product-details .tabs-nav').find('a[href=#panelreviews]').parent().addClass('current-menu-item');
    $('.tabs li, .tabs-inner,.panel.entry-content').removeClass('active');
    $('.tabs li.reviews_tab, #panelreviews, #tab-reviews').addClass('active');
    $('.panel.entry-content').css('display','none');
    $('#tab-reviews').css('display','block');
    $.scrollTo('#panelreviews',300,{offset:-90});
    $.scrollTo('.reviews_tab',300,{offset:-90});
    $.scrollTo('#section-reviews',300,{offset:-90});
    e.preventDefault();
});


// For demo

     $('.show-theme-options').click(function(){
        $(this).parent().toggleClass('open');
        $(window).resize();
        $(window).scroll();

        return false;
      });

     $('.ss-button').click(function(){
      location.reload();
     })
      

    $('.wide-button').click(function(){
      $('body').removeClass('boxed');
      $(this).addClass('active');
      $('.config-options').find('.ss-content .boxed-button').removeClass('active');
      $.cookie('layout', null, { path: '/' });
    });

    $('.boxed-button').click(function(){
      $('body').addClass('boxed');
      $(this).addClass('active');
      $('.config-options').find('.ss-content .wide-button').removeClass('active');
      $.cookie('layout' , 'boxed' , {path: '/'});
    });

    if (($.cookie('layout') != null) && ($.cookie('layout') == 'boxed')){
      $('body').addClass('boxed');
      $('.boxed-button').addClass('active');
      $('.wide-button').removeClass('active');
    } 

    $('.ss-color').click(function(){
      var datastyle = $(this).attr('data-style');
      $('head').append("<link rel='stylesheet' href='"+datastyle+"'  type='text/css' />");
      if (($.cookie('data-style') != null) && ($.cookie('data-style') != datastyle)){
        $.cookie('data-style', null, { path: '/' });
      }
      $.cookie('data-style',datastyle,{path: '/'});
    });

    $( document ).ready(function() {
      if ($.cookie('data-style') != null){
        $('head').append("<link rel='stylesheet' href='"+$.cookie('data-style')+"'  type='text/css' />");
      }
    });

    $('.ss-image').click(function(){
        var pattern = $(this).attr('data-pattern');
        $('html').css({"background-image": "url('"+pattern+"')", "background-attachment": "fixed"});
        $('body').css("background-color", "transparent");
        if (($.cookie('data-bg') != null) && ($.cookie('data-bg') != pattern)){
          $.cookie('data-bg', null, { path: '/' });
        }
        $.cookie('data-bg',pattern,{path: '/'});
    });
    
    $( document ).ready(function() {
      if ($.cookie('data-bg') != null){
        $('html').css({"background-image": "url('"+$.cookie('data-bg')+"')", "background-attachment": "fixed"});
        $('body').css("background-color", "transparent");
      }
    });
   
// End For demo


$('.widget_nav_menu .menu-parent-item').hoverIntent(
    function () {
        $(this).find('ul').slideDown();
    },
    function () {
       $(this).find('ul').slideUp();
    }
);


$('.collapses').each(function(){
  var acc = $(this).attr("rel") * 2;
  $(this).find('.collapses-inner:nth-child(' + acc + ')').show();
  $(this).find('.collapses-inner:nth-child(' + acc + ')').prev().addClass("active");
});
  
$('.collapses .collapses-title').click(function() {
  if($(this).next().is(':hidden')) {
    $(this).parent().find('.collapses-title').removeClass('active').next().slideUp(200);
    $(this).toggleClass('active').next().slideDown(200);
  } else {
    $(this).parent().find('.collapses-title').removeClass('active').next().slideUp(200);
  }
  return false;
});




$('.shortcode_tabgroup ul.tabs li a').click(function(e){
  e.preventDefault();
  $(this).parent().parent().parent().find('ul li').removeClass('active');
  $(this).parent().addClass('active');
  var currentTab = $(this).attr('href');
  $(this).parent().parent().parent().find('div.panel').removeClass('active');
  $(currentTab).addClass('active');

  var iOS = ( navigator.userAgent.match(/(Android|webOS|iPhone|iPad|iPod|BlackBerry)/g) ? true : false );
  if($(currentTab).find('.iosSlider') && iOS) {
    $(currentTab).find('.iosSlider').each(function(i){
      var id = $(this).attr('id');
      $('#'+id).iosSlider('update').iosSlider('goToSlide', 1);
    });
  }
  $(window).resize();
  return false;
});

$('.product-details .tabbed-content .tabs a').click(function(){
  var panel = $(this).attr('href');
  $(panel).addClass('active');
  return false;
});


$('.shortcode_tabgroup_vertical ul.tabs-nav li a').click(function(e){
  e.preventDefault();
  $(this).parent().parent().parent().find('ul li').removeClass('current-menu-item');
  $(this).parent().addClass('current-menu-item');
  var currentTab = $(this).attr('href');
  $(this).parent().parent().parent().parent().find('div.tabs-inner').removeClass('active');
  $(currentTab).addClass('active');

  $(window).resize();
  return false;
});

if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $('.yith-wcwl-wishlistexistsbrowse.show').each(function(){
      var tip_message = $(this).find('a').text();
      $(this).find('a').attr('data-tip',tip_message).addClass('tip-top');
  });

  $('.yith-wcwl-add-button.show').each(function(){
      var tip_message = $(this).find('a.add_to_wishlist').text();
      $(this).find('a.add_to_wishlist').attr('data-tip',tip_message).addClass('tip-top');
  });

  $('.tip,.tip-bottom').tipr();
  $('#main-content .tip-top, .footer .tip-top, .absolute-footer .tip-top, .featured-box .tip-top, .quick-view .tip-top').tipr({mode:"top"});
  $('#top-bar .tip-top, #header-outer-wrap .tip-top').tipr({mode:"bottom"});
}

$('.bery_banner .center').vAlign();
$( window ).resize(function() {
  $('.bery_banner .center').vAlign();
});

$('.col_hover_focus').hover(function(){
  $(this).parent().find('.columns > *').css('opacity','0.5');
}, function() {
  $(this).parent().find('.columns > *').css('opacity','1');
});

$('.slider .add_to_cart_button').hover(
  function() {
    $('.sliderControlls').css('pointer-events','none');
  }, function() {
    $('.sliderControlls').css('pointer-events','all');
  }
);

$('.add-to-cart-grid.product_type_simple').click(function(){
  jQuery('.mini-cart').addClass('active cart-active');
  jQuery('.mini-cart').hover(function(){jQuery('.cart-active').removeClass('cart-active');});
  setTimeout(function(){jQuery('.cart-active').removeClass('active')}, 5000);
});

$('.row ~ br').remove();
$('.columns ~ br').remove();
$('.columns ~ p').remove();
$('#megaMenu').wrap('<li/>');
$('select.ninja-forms-field,select.addon-select').wrap('<div class="custom select-wrapper"/>');
$(window).resize();


$('.prod-slider-1').owlCarousel({
  navigation : true,
  slideSpeed : 300,
  pagination: false,
  paginationSpeed : 400,
  autoPlay : true,
  stopOnHover : true,
  itemsCustom : [
    [0, 1],
    [450, 1],
    [600, 1],
    [700, 1],
    [1000, 1],
    [1200, 1],
    [1400, 1],
    [1600, 1]
  ],
  navigationText: ["", ""]
  });

$('.prod-slider-3').owlCarousel({
  navigation : true,
  slideSpeed : 300,
  pagination: false,
  paginationSpeed : 400,
  autoPlay : true,
  stopOnHover : true,
  itemsCustom : [
    [0, 1],
    [450, 1],
    [600, 2],
    [700, 2],
    [1000, 3],
    [1200, 3],
    [1400, 3],
    [1600, 3]
  ],
  navigationText: ["", ""]
  });

$('.prod-slider-4').owlCarousel({
  navigation : false,
  slideSpeed : 300,
  pagination: false,
  paginationSpeed : 500,
  autoPlay : true,
  stopOnHover : true,
  itemsCustom : [
    [0, 1],
    [450, 1],
    [600, 2],
    [700, 2],
    [1000, 4],
    [1200, 4],
    [1400, 4],
    [1600, 4]
  ],
  navigationText: ["", ""]
  });

$('.prod-slider-5').owlCarousel({
  navigation : true,
  slideSpeed : 300,
  pagination: false,
  paginationSpeed : 400,
  autoPlay : true,
  stopOnHover : true,
  itemsCustom : [
    [0, 1],
    [450, 1],
    [600, 2],
    [700, 2],
    [1000, 5],
    [1200, 5],
    [1400, 5],
    [1600, 5]
  ],
  navigationText: ["", ""]
  });

$('.prod-cat-slider-4').owlCarousel({
  navigation : true,
  slideSpeed : 300,
  pagination: false,
  paginationSpeed : 500,
  autoPlay : false,
  stopOnHover : true,
  itemsCustom : [
    [0, 1],
    [450, 1],
    [600, 2],
    [700, 2],
    [1000, 4],
    [1200, 4],
    [1400, 4],
    [1600, 4]
  ],
  navigationText: ["", ""]
  });

$('.main-images').owlCarousel({
    items:1,
    lazyLoad: false,
    rewindNav: false,
    addClassActive: true,
    autoHeight : true,
    navigation: false,
    pagination: false,
    autoPlay : false,
    itemsCustom: [1600, 1],
    afterMove: function(args) {
        var owlMain = $(".main-images").data('owlCarousel');
        var owlThumbs = $(".product-thumbnails").data('owlCarousel');
        $('.active-thumbnail').removeClass('active-thumbnail')
        $(".product-thumbnails").find('.owl-item').eq(owlMain.currentItem).addClass('active-thumbnail');
        if(typeof owlThumbs != 'undefined') {
          owlThumbs.goTo(owlMain.currentItem-1);
        }
    }
});


$('.main-images a').click(function(e){
    e.preventDefault();
})

$('.product-thumbnails').owlCarousel({
    items : 3,
    transitionStyle:"fade",
    navigation: false,
    pagination: false,
    autoPlay : false,
    autoHeight : true,
    navigationText: ["",""],
    addClassActive: true,
    itemsCustom: [[0, 2], [479,2], [619,3], [768,4], [1200, 4], [1600, 4]],
}); 

$('.product-thumbnails .owl-item a').click(function(e) {
  e.preventDefault();
});

$('.product-thumbnails .owl-item').click(function(e) {
    var owlMain = $(".main-images").data('owlCarousel');
    var owlThumbs = $(".product-thumbnails").data('owlCarousel');
    owlMain.goTo($(e.currentTarget).index());
    e.preventDefault();
});


$('.section-title, .widgettitle').each(function() {
  var txt = $(this).html();
  var index = txt.indexOf(' ');
  if (index == -1) {
     index = txt.length;
  }
  $(this).html('<span>' + txt.substring(0, index) + '</span>' + txt.substring(index, txt.length));
});


// **********************************************************************// 
// ! Promo popup
// **********************************************************************//

var et_popup_closed = $.cookie('leetheme_popup_closed');
$('.leetheme-popup').magnificPopup({
    items: {
      src: '#leetheme-popup',
      type: 'inline'
    },
    removalDelay: 300, //delay removal by X to allow out-animation
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = 'my-mfp-slide-bottom';
        },
        beforeClose: function() {
        if($('#showagain:checked').val() == 'do-not-show')
            $.cookie('leetheme_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
        },
    }
  // (optionally) other options
});

if(et_popup_closed != 'do-not-show' && $('.leetheme-popup').length > 0 && $('body').hasClass('open-popup')) {
    $('.leetheme-popup').magnificPopup('open');
}



}(jQuery));

