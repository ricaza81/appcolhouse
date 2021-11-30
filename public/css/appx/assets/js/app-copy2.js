var GPTHEME = GPTHEME || {};

(function($) {

  /*!----------------------------------------------
      # This beautiful code written with heart
      # by Mominul Islam <me@mominul.me>
      # In Dhaka, BD at the Gp Theme workstation.
      ---------------------------------------------*/

  // USE STRICT
  "use strict";

  GPTHEME.initialize = {

    init: function() {
      GPTHEME.initialize.general();
      GPTHEME.initialize.mobileMenu();
      GPTHEME.initialize.sectionBackground();
      GPTHEME.initialize.sectionSwitch();
      GPTHEME.initialize.countUp();
      GPTHEME.initialize.countDown();
      GPTHEME.initialize.magicLine();
      GPTHEME.initialize.googleMap();
      GPTHEME.initialize.contactForm();

    },

    /*========================================================*/
    /*=           Collection of snippet and tweaks           =*/
    /*========================================================*/

    general: function() {

      /*  Active Menu */
      // $('.site-menu li a').on('click', function() {
      // 	$('.site-menu').find('.menu__item--current').removeClass('menu__item--current');
      // 	$(this).parent().addClass('menu__item--current');
      // });

      $(".site-menu li a").on("click", function() {
        $(".site-menu li a").removeClass("menu__item--current");
        $(this).addClass("menu__item--current");
      });


      $('.toggle-menu').on('click', function() {
        $('.site-menu').slideToggle(500);
        $(this).toggleClass('active');
      })

      $(".page-loader").fadeOut("slow");

      $('#download-two').raindrops({
        color: '#f9fbff',
        canvasHeight: 150,
        waveLength: 100,
        rippleSpeed: 0.05,
        density: 0.04
      });

      $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1000,
        arrows: true,
        asNavFor: '.slider-nav',
        prevArrow: '<div class="PrevArrow"> <span class="ei ei-arrow_left"></span></div>',
        nextArrow: '<div class="NextArrow"> <span class="ei ei-arrow_right"></span></div>',
      });

      $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
      });



      var $scene = $('.scene').parallax({
        scalarX: 15,
        scalarY: 40,
      });


      /* Footer Fixed */
      var footerFixed = $('#site-footer').outerHeight();

      if ($(document).width() > 768) {
        $('#site').css('margin-bottom', footerFixed);
      }

      /* Accordion  */
      $('.faq_accordian_two .card').each(function() {
        var $this = $(this);
        $this.on('click', function(e) {
          var has = $this.hasClass('active');
          $('.faq_accordian_two .card').removeClass('active');
          if (has) {
            $this.removeClass('active');
          } else {
            $this.addClass('active');
          }
        });
      });


      $('.swiper-container').each(function() {
        new SwiperRunner($(this));
      });


      /* Magnefic Popup */
      $('.popup-btn').magnificPopup({
        type: 'image'

      });
    },

    /*==================================*/
    /*=           Mobile Menu          =*/
    /*==================================*/

    mobileMenu: function() {

      // Menu fixded
      if ($('header .header-main').length && $('header .header-main').hasClass('gp-header-sticky')) {
        var header_position = $('header .header-main').offset(),
          lastScroll = 50;
        var window_height = $(window).height();
        $(window).on('scroll load', function(event) {
          var st = $(this).scrollTop();
          if (st > header_position.top) {
            if ($(".gp-header-table").length)
              $('header .gp-header-table').addClass("gp-header-fixed");
            else
              $('header .header-main').addClass("gp-header-fixed");
          } else {
            if ($(".gp-header-table").length)
              $('header .gp-header-table').removeClass("gp-header-fixed");
            else
              $('header .header-main').removeClass("gp-header-fixed");
          }

          if (st > lastScroll && st > header_position.top) {
            if ($(".gp-header-table").length)
              $('header .gp-header-table').addClass("gp-hidden-menu");
            else
              $('header .header-main').addClass("gp-hidden-menu");
          } else if (st <= lastScroll) {
            if ($(".gp-header-table").length)
              $('header .gp-header-table').removeClass("gp-hidden-menu");
            else
              $('header .header-main').removeClass("gp-hidden-menu");
          }

          lastScroll = st;

          if (st == 0) {
            if ($(".gp-header-table").length)
              $('header .gp-header-table').removeClass("gp-header-fixed");
            else
              $('header .header-main').removeClass("gp-header-fixed");
          }
        });
      }
    },

    /*==========================================*/
    /*=           Section Background           =*/
    /*==========================================*/

    sectionBackground: function() {

      // Section Background Image
      $('[data-bg-image]').each(function() {
        var img = $(this).data('bg-image');
        $(this).css({
          backgroundImage: 'url(' + img + ')',
        });
      });

      //Parallax Background
      $('[data-parallax="image"]').each(function() {

        var actualHeight = $(this).position().top;
        var speed = $(this).data('parallax-speed');
        var reSize = actualHeight - $(window).scrollTop();
        var makeParallax = -(reSize / 2);
        var posValue = makeParallax + "px";

        $(this).css({
          backgroundPosition: '50% ' + posValue,
        });
      });
    },

    /*=========================================*/
    /*=           Section Background          =*/
    /*=========================================*/

    sectionSwitch: function() {
      $('[data-type="section-switch"], .site-menu li a').on('click', function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

          var target = $(this.hash);

          if (target.length > 0) {

            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    },

    /*==============================*/
    /*=           Countup          =*/
    /*==============================*/
    countUp: function() {
      var options = {
        useEasing: true,
        useGrouping: true,
        separator: ',',
        decimal: '.',
        prefix: '',
        suffix: ''
      };

      var counteEl = $('[data-counter]');

      if (counteEl) {
        counteEl.each(function() {
          var val = $(this).data('counter');

          var countup = new CountUp(this, 0, val, 0, 2.5, options);
          $(this).appear(function() {
            countup.start();
          }, {
            accX: 0,
            accY: 0
          })
        });
      }
    },

    /*=================================*/
    /*=           Count Down          =*/
    /*=================================*/

    countDown: function() {
      $('.countdown').each(function(index, value) {
        var count_year = $(this).attr("data-count-year");
        var count_month = $(this).attr("data-count-month");
        var count_day = $(this).attr("data-count-day");
        var count_date = count_year + '/' + count_month + '/' + count_day;
        $(this).countdown(count_date, function(event) {
          $(this).html(
            event.strftime('<span class="CountdownContent">%D<span class="CountdownLabel"></span></span><span class="CountdownSeparator"></span><span class="CountdownContent">%H <span class="CountdownLabel"></span></span><span class="CountdownSeparator"></span><span class="CountdownContent">%M <span class="CountdownLabel"></span></span><span class="CountdownSeparator"></span><span class="CountdownContent">%S <span class="CountdownLabel"></span></span>')
          );
        });
      });
    },

    /*===================================*/
    /*=           Masic Border          =*/
    /*===================================*/
    magicLine: function() {


      $('[data-appxbe-tab-box]').each(function() {
        var box = $(this);
        var buttons = $(this).find('.button');
        var buttonsWrap = $(this).find('.buttons');
        var line = $(this).find('.buttons .line');
        var items = $(this).find('.item');
        var options = (box.attr('data-options')) ? JSON.parse(box.attr('data-options')) : {};

        // Initializtion
        if (buttons.length == 0) {
          items.each(function() {
            var title = $(this).attr('data-title');
            box.find('.buttons').append($(document.createElement('li')).addClass('button ' + options.tabClass).html(title));
          });
          buttons = $(this).find('.button');
          buttons.eq(0).addClass('active ' + options.tabActiveClass);
        }
        items.eq(0).addClass('active');

        items.addClass(options.itemClass);


        // Process
        var refresh = function() {
          // Height
          var activeItem = box.find('.item.active');
          if (box.hasClass('vertical') && buttonsWrap.outerHeight() > activeItem.outerHeight()) {
            box.find('.items').css('height', buttonsWrap.outerHeight() + 'px');
          } else {
            box.find('.items').css('height', activeItem.outerHeight() + 'px');
          }

          // Line
          var active = box.find('.buttons .active');
          if (box.hasClass('vertical')) {
            line.css({
              'height': active.outerHeight() + 'px',
              'transform': 'translateY(' + (active.offset().top - buttonsWrap.offset().top) + 'px)'
            });
          } else {
            line.css({
              'width': active.outerWidth() + 'px',
              'transform': 'translateX(' + (active.offset().left - buttonsWrap.offset().left + buttonsWrap.scrollLeft()) + 'px)'
            });
          }
        };

        buttons.on('click', function() {
          buttons.removeClass('active ' + options.tabActiveClass).addClass(options.tabClass);
          items.removeClass('active');

          $(this).addClass('active ' + options.tabActiveClass);
          items.eq($(this).index() - 1).addClass('active');

          refresh();
        });


        refresh();
      });


      $('[data-appxbe-tab-box]').each(function() {
        var box = $(this);
        var activeItem = box.find('.item.active');
        var buttonsWrap = box.find('.buttons');

        if (box.hasClass('vertical') && buttonsWrap.outerHeight() > activeItem.outerHeight()) {
          box.find('.items').css('height', buttonsWrap.outerHeight() + 'px');
        } else {
          box.find('.items').css('height', activeItem.outerHeight() + 'px');
        }
      });
    },


    /*=================================*/
    /*=           Google Map          =*/
    /*=================================*/
    googleMap: function() {
      $('.gmap3-area').each(function() {
        var $this = $(this),
          key = $this.data('key'),
          lat = $this.data('lat'),
          lng = $this.data('lng'),
          mrkr = $this.data('mrkr');

        $this.gmap3({
            center: [lat, lng],
            zoom: 10,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{
              "featureType": "administrative",
              "elementType": "all",
              "stylers": [{
                "color": "#ffffff"
              }]
            }, {
              "featureType": "administrative",
              "elementType": "geometry.fill",
              "stylers": [{
                "color": "#ff0000"
              }]
            }, {
              "featureType": "administrative",
              "elementType": "labels.text.fill",
              "stylers": [{
                "color": "#23232c"
              }]
            }, {
              "featureType": "landscape",
              "elementType": "all",
              "stylers": [{
                "color": "#e4e4e4"
              }, {
                "gamma": "1"
              }, {
                "saturation": "3"
              }, {
                "lightness": "31"
              }]
            }, {
              "featureType": "landscape.man_made",
              "elementType": "geometry.fill",
              "stylers": [{
                "color": "#f3f3f3"
              }]
            }, {
              "featureType": "landscape.natural",
              "elementType": "all",
              "stylers": [{
                "color": "#aacf89"
              }, {
                "saturation": "20"
              }, {
                "lightness": "1"
              }]
            }, {
              "featureType": "landscape.natural",
              "elementType": "labels.text.fill",
              "stylers": [{
                "color": "#000000"
              }]
            }, {
              "featureType": "landscape.natural.landcover",
              "elementType": "geometry.fill",
              "stylers": [{
                "color": "#9acf89"
              }]
            }, {
              "featureType": "landscape.natural.terrain",
              "elementType": "geometry.fill",
              "stylers": [{
                "color": "#f3f3f3"
              }]
            }, {
              "featureType": "poi",
              "elementType": "all",
              "stylers": [{
                "visibility": "off"
              }]
            }, {
              "featureType": "road",
              "elementType": "all",
              "stylers": [{
                "saturation": -100
              }, {
                "lightness": 45
              }]
            }, {
              "featureType": "road.highway",
              "elementType": "all",
              "stylers": [{
                "visibility": "simplified"
              }]
            }, {
              "featureType": "road.arterial",
              "elementType": "labels.icon",
              "stylers": [{
                "visibility": "off"
              }]
            }, {
              "featureType": "transit",
              "elementType": "all",
              "stylers": [{
                "visibility": "off"
              }]
            }, {
              "featureType": "water",
              "elementType": "all",
              "stylers": [{
                "color": "#91a5d7"
              }, {
                "visibility": "on"
              }, {
                "lightness": "44"
              }, {
                "saturation": "82"
              }]
            }, {
              "featureType": "water",
              "elementType": "labels.text.fill",
              "stylers": [{
                "color": "#ffffff"
              }]
            }]
          })
          .marker(function(map) {
            return {
              position: map.getCenter(),
              icon: mrkr
            };
          })

      });
    },

    /*=================================*/
    /*=           Contact Form          =*/
    /*=================================*/
    contactForm: function() {
      $('[data-deventform]').each(function() {
        var $this = $(this);
        $('.form-result', $this).css('display', 'none');

        $this.submit(function() {

          $('button[type="submit"]', $this).addClass('clicked');

          // Create a object and assign all fields name and value.
          var values = {};

          $('[name]', $this).each(function() {
            var $this = $(this),
              $name = $this.attr('name'),
              $value = $this.val();
            values[$name] = $value;
          });

          // Make Request
          $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            data: values,
            success: function success(data) {
              if (data.error == true) {
                $('.form-result', $this).addClass('alert-warning').removeClass('alert-success alert-danger').css('display', 'block');
              } else {
                $('.form-result', $this).addClass('alert-success').removeClass('alert-warning alert-danger').css('display', 'block');
              }
              $('.form-result > .content', $this).html(data.message);
              $('button[type="submit"]', $this).removeClass('clicked');
            },
            error: function error() {
              $('.form-result', $this).addClass('alert-danger').removeClass('alert-warning alert-success').css('display', 'block');
              $('.form-result > .content', $this).html('Sorry, an error occurred.');
              $('button[type="submit"]', $this).removeClass('clicked');
            }
          });
          return false;
        });

      });
    },

  };

  GPTHEME.documentOnReady = {
    init: function() {
      GPTHEME.initialize.init();

      $('#feel-the-wave').wavify({
        height: 150,
        bones: 7,
        amplitude: 90,
        color: 'rgba(255, 255, 255, 0.06)',
        speed: .21
      });

      $('#wave-two').wavify({
        height: 150,
        bones: 8,
        amplitude: 70,
        color: 'rgba(255, 255, 255, 0.06)',
        speed: .24
      });

    },
  };

  GPTHEME.documentOnLoad = {
    init: function() {

    },
  };

  GPTHEME.documentOnResize = {
    init: function() {

    },
  };

  GPTHEME.documentOnScroll = {
    init: function() {
      GPTHEME.initialize.sectionBackground();

    },
  };

  // Initialize Functions
  $(document).ready(GPTHEME.documentOnReady.init);
  $(window).on('load', GPTHEME.documentOnLoad.init);
  $(window).on('resize', GPTHEME.documentOnResize.init);
  $(window).on('scroll', GPTHEME.documentOnScroll.init);

})(jQuery);