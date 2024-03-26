/* eslint-disable */

export default {
  init() {
    // JavaScript to be fired on all pages
    $(document).ready(function() {
      /* eslint-disable */
      AOS.init();
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired

    $(document).ready(function() {
         $('.parallax-on').paroller();

		var $hamburger = $('.hamburger');
		$hamburger.on('click', function() {
			$hamburger.toggleClass('is-active');
		});

      $('.faq-section .btn-accordion').on('click', function (){
        $(this).parent().toggleClass('show')
        // $('.faq-section .accor-wrap').addClass('show');
      });

      setTimeout(function() {
        $('.owl-carousel').owlCarousel({
          loop:true,
          margin:0,
          nav:false,
          items: 1,
          dots: true,
        })
      }, 200);

      $('.experience-carousel').owlCarousel({
        loop: false,
        nav: false,
        items: 1,
        dots: false,
        autoHeight: true,
        autoplay: true,
        autoplayTimeout:7000,
        stopOnHover:false,
      });

      $('.experience-carousel .sum-1').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        autoplay:true,
        autoplayTimeout:5000,
      });

      $('.experience-carousel .sum-2').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        autoplay:true,
        autoplayTimeout:9000,
      });

      $('.experience-carousel .sum-3').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        autoplay:true,
        autoplayTimeout:13000,
      });

      // $('.wrap-carousel').owlCarousel({
      //   loop: true,
      //   margin: 0,
      //   nav: false,
      //   items: 1,
      //   dots: false,
      //   autoplay:true,
      //   autoplayTimeout:5000,
      // });

      $('.surrounding-tab-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        items: 3,
        dots: false,
        autoWidth:true,
        // autoplayTimeout:5000,
        responsiveClass:true,
        responsive:{
          0:{
            items:2,
          },
          768:{
            items:3,
          },
          1200:{
            items:4,
          }
        }
      });

      $('.img-carousel').owlCarousel({
        loop: true,
        autoplay:true,
        autoplayTimeout:5000,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
      });

      $(document).ready(function() {
        var $videoSrc;
        $('.video-btn').click(function() {
          $videoSrc = $(this).data( 'src' );
            if ($videoSrc.indexOf("youtube") >= 0) {
                $.urlParam = function (name) {
                    var results = new RegExp('[\?&]' + name + '=([^&#]*)')
                        .exec($videoSrc);

                    return (results !== null) ? results[1] || 0 : false;
                }
                $videoSrc = 'https://www.youtube.com/embed/'+$.urlParam('v');
            }
            console.log($videoSrc);
        });

        $('#videoModal').on('shown.bs.modal', function () {
          $('#video').attr('src',$videoSrc + '?autoplay=1&modestbranding=1&rel=0&showinfo=0&color=white' );
        });

        // stop playing
        $('#videoModal').on('hide.bs.modal', function () {
          // a poor man's stop video
          $('#video').attr('src',$videoSrc);
        });
      });

      $(document).bind('gform_post_render', function(){
        if ( jQuery('div.validation_error').length > 0 ) {
          // console.log('Form validation error.');
          $('.icon-top').removeClass('check');
          $('.icon-top').find('div').attr('class', '');
          $('.icon-top').find('div').addClass('cross');
          $('.notif-title').text('Something went wrong');
          $('.notif-message').text('Please go back and try again.');
          $('#notificationModal').modal('show');
        }
      });

      $(document).bind('gform_confirmation_loaded', function (e, form_id) {
        // code to run upon successful form submission
        // console.log('Form confirmation.');
        // console.log(form_id);
        // console.log('#gform_confirmation_message_' + form_id);
        // console.log(confirmation_message);
        var confirmation_message = $('#gform_confirmation_message_' + form_id).text();

        //$('#gform_confirmation_message_' + form_id).hide();
        $('.icon-top').addClass('check');
        $('.icon-top').find('div').attr('class', '');
        $('.icon-top').find('div').addClass('square');
        $('.notif-message').text(confirmation_message);
        $('.notif-title').text('Success!');
        $('#notificationModal').modal('show');
      });

      $('.hide-modal').click(function(e) {
        e.preventDefault();
        $('#notificationModal').modal('hide');
      })

      $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
          scrollTop: $($.attr(this, 'href')).offset().top - 100,
        }, 500);
      });

      /* Function for change tab section */
      $('.section-surrounding-tabs').on('click', '.surrounding-tab-carousel .wrapper', function () {
        console.log('clicked');
        $('.outer-tab-name .wrapper').removeClass('active');
        $('.outer-content .inner-wrapper').removeClass('active');
        var tabdata = $(this).attr('data-tab');
        $('.outer-content .inner-wrapper.' + tabdata).removeClass('fadeshow');

        $(this).addClass('active');
        var datatab = $(this).attr('data-tab');
        $('.outer-content .inner-wrapper.' + datatab).addClass('active');
        $('.outer-content .inner-wrapper.' + datatab).addClass('fadeshow');
      });
    });
  },
};
