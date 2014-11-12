var $ = jQuery.noConflict();

var baseurl = 'http://www.nextwpthemes.com/themes/kollar/vertical/'; //i teregojme ne dokumentim qe duhet me shkru baseurl

$(document).ready(function($) {
	$('textarea').autosize();

	/* ---------------------------------------------------------------------- */
	/*	NiceScroll code
	/* ---------------------------------------------------------------------- */
	var nicesx = $('body').niceScroll({touchbehavior:false,cursorcolor:"#b2267c",cursoropacitymax:1,cursorwidth:8});

	/* ---------------------------------------------------------------------- */
	/*	image loader
	/* ---------------------------------------------------------------------- */
	$(window).load(function(){
		$('#loading').delay(1000).animate({'opacity': 0}, 600);
		$('#content').delay(1000).animate({'opacity': 1}, 600, function(){
			$(this).imagesLoaded(function(){
				reconstructIsotope();
			})
			$('body').delay(1000).getNiceScroll().resize();
		});
		$('.loader').delay(1000).animate({'opacity': 0}, 600);
	});

	/* ---------------------------------------------------------------------- */
	/*	Croping images with timthumb
	/* ---------------------------------------------------------------------- */
	$('#content.content1 a.post-gallery > img').each(function(){
		$(this).attr({'src': baseurl + 'php/timthumb.php?src=' + baseurl + $(this).attr('data-src') + '&w=480&h=305&zc=1'});
	});

	/* ---------------------------------------------------------------------- */
	/*	Move prjects
	/* ---------------------------------------------------------------------- */
	$('#next-project').live('click', function(){
		var current_project = $('a.project[data-id="'+ $(this).parents('section.slider').attr('data-id') +'"]').parents('div.post')

		if(current_project.next().is('div.post')){
			var next_project = current_project.next('div.post').children('div.post-content').find('a.project').attr('data-id');
			get_project(next_project, true);
		}
	});

	$('#prev-project').live('click', function(){
		var current_project = $('a.project[data-id="'+ $(this).parents('section.slider').attr('data-id') +'"]').parents('div.post')

		if(current_project.prev().is('div.post:gt(0)')){
			var prev_project = current_project.prev('div.post').children('div.post-content').find('a.project').attr('data-id');
			get_project(prev_project, true);
		}
	});

	/* ---------------------------------------------------------------------- */
	/*	Isotope Code
	/* ---------------------------------------------------------------------- */
		var $container	 	= $('#content');
		var $filter 		= $('.gallery-filter');

		$(window).bind('resize', function(){
			var selector = $filter.find('a.active4').attr('data-filter');
			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
			   		}
				});
			  	return false;
			} catch(err) {

			}
		});
		
		// Isotope Filter 
		$filter.find('a').click(function(){
			var selector = $(this).attr('data-filter');
			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
			   		}
				});
			  	return false;
			} catch(err) {

			}
		});

		// Run Isotope  
		$(window).load(function(){
			try {
				$container.isotope({
					filter				: '*',
					layoutMode   		: 'masonry',
					animationOptions	: {
					duration			: 750,
					easing				: 'linear'
				   }
				});
			} catch(err) {

			}
		});

	/* ---------------------------------------------------------------------- */
	/*	Post zoom
	/* ---------------------------------------------------------------------- */
	$('div.post a.zoom').live('click', function(e){
		e.preventDefault();

		var x = $(this).parents('div.post'),
			indx = x.index();
			gal = x.find('.post-gallery');

			var storage = document.createElement('div');
				$(storage).load("projects.html section.slider[data-id="+ indx +"] img", function(){
					$(storage).find('img:gt(0)').appendTo(gal);
				});
					
		$(".large-post.active").removeClass('active');
		$('div.post.opened div.post-content').removeClass('active');
		$('div.post.opened').removeClass('opened');

		x.find('div.post-content').addClass('active');
		x.addClass('opened');
		x.find(".large-post").addClass('active');
		setTimeout("reconstructIsotope();", 500 );
		$('.close, .gallery-filter li a, .project').live('click', function(){
			x.find('div.post-content').removeClass('active');
			x.find(".large-post").removeClass('active');
			setTimeout("reconstructIsotope();", 500);
			$('div.post.opened').removeClass('opened');
			$('.post-gallery').find('img:gt(0)').remove();
			$('.post-gallery').find('img:first-child').addClass('open');
		});
	});

	/* ---------------------------------------------------------------------- */
	/*	Post: slide prev and next images after zoom 
	/* ---------------------------------------------------------------------- */
	$('.prev').live('click', function(e){
		e.preventDefault();

		var x = $(this).parents('div.post').find('a.post-gallery img.open');
		var y = x.index();
		if ( y > 0 ){
				x.removeClass('open')
				.prev('img')
				.addClass('open');
		}
	});

	$('.next').live('click', function(e){
		e.preventDefault();

		var x = $(this).parents('div.post').find('a.post-gallery img.open');
		var y = x.index();
		var z = $(this).parents('div.post').find('a.post-gallery img').length;

		if ( y < z-1){
				x.removeClass('open')
				.next('img')
				.addClass('open');
		}
	});

	/* ---------------------------------------------------------------------- */
	/*	shortcodes toogle
	/* ---------------------------------------------------------------------- */
	$('ul.toogle li a').live('click', function(e){
		e.preventDefault();

		if(!$(this).parents('li').hasClass('active')){
			$('ul.toogle li').removeClass('active');
			$(this).parents('li').addClass('active');
		}
	});

	/* ---------------------------------------------------------------------- */
	/*	shortcodes toogle
	/* ---------------------------------------------------------------------- */	
	$('.tab-list li').live('click', function(){
		var $this = $(this),
			x = $(this).index();
		if( !$this.hasClass('active')) {
			$('.tab-list li').removeClass('active');
			$this.addClass('active');
			$('.tab-cont li').fadeOut(200);
			$('.tab-cont li:eq('+ x +')').delay(200).fadeIn(200);
		}
	});

	/* ---------------------------------------------------------------------- */
	/* open and close single-project
	/* ---------------------------------------------------------------------- */
	$('.project').live('click', function(e){
		e.preventDefault();

		$('#loading').animate({'opacity': 1}, 100);
		get_project($(this).attr("data-id"));
	});

	$('#close-project').live('click', function(e){
		e.preventDefault();
		
		$('#content').fadeIn(0).animate({'margin-left':'0'},1000, function(){
			$('#single-post').animate({'margin-left':'-100%'},1).fadeOut(100, function(){ $('#single-post').html(""); });
			setTimeout("reconstructIsotope();", 500);
		});
		$('header').animate({'margin-top':'0'});
		$('#filter').fadeIn();
		$('body').delay(1000).getNiceScroll().resize();
	});

	/*-------------------------------------------------*/
	/* =  infite scroll
	/*-------------------------------------------------*/
	try {
	      var $content = $('#content');
	    
	      $content.isotope({
	        itemSelector : '.post, .blog-post'
	      });
	      
	      $content.infinitescroll({
	        navSelector  : '#page-nav',    // selector for the paged navigation 
	        nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
	        itemSelector : '.post',     // selector for all items you'll retrieve
	        debug : true,
	        extraScrollPx: 500,
	        bufferPx     : 40,
	        loading: {
	            finishedMsg: '',
	            img: 'images/kollar-loader.gif'
	          }
	        },
	        // call Isotope as a callback
	        function( newElements ) {
	          $content.isotope( 'appended', $( newElements ), function(){
	          	reconstructIsotope();
	          } ); 
	        });
	    } catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  Fancybox Images
	/*-------------------------------------------------*/
	try {

		$(".zoom1").fancybox({
			nextEffect	: 'fade',
			prevEffect	: 'fade',
			openEffect	: 'fade',
	    	closeEffect	: 'fade',
	          helpers: {
	              title : {
	                  type : 'float'
	              }
	          }
		});

		$('.video').fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '75%',
			height		: '75%',
			type 		: 'iframe',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'fade',
			closeEffect	: 'fade'
		});

	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	Contact info or full map
	/* ---------------------------------------------------------------------- */
	$('#full-map a').live('click', function(e){
		e.preventDefault();
		
		var $this = $(this);
		if(!$('.contact-info, .contact-form').hasClass('active')){
			$('.contact-info, .contact-form').addClass('active');
			$this.text('Contact').parent('#full-map').addClass('active');
		}
		else {
			$('.contact-info, .contact-form').removeClass('active');
			$this.text('full map').parent('#full-map').removeClass('active');
		}
	});

	/* ---------------------------------------------------------------------- */
	/*	Contact Map
	/* ---------------------------------------------------------------------- */
	var contact = {"lat":"51.512428", "lon":"0.043962"}; //Change a map coordinate here!

	try {
		$('#map').gmap3({
		    action: 'addMarker',
		    latLng: [contact.lat, contact.lon],
		    map:{
		    	center: [contact.lat, contact.lon],
		    	zoom: 14
		   		},
		    },
		    {action: 'setOptions', args:[{scrollwheel:true}]}
		);
	} catch(err) {

	}
	
	/* ---------------------------------------------------------------------- */
	/*	Contact Form
	/* ---------------------------------------------------------------------- */
	$('#submit_contact').on('click', function(e){
		e.preventDefault();

		$this = $(this);
		
		$.ajax({
			type: "POST",
			url: 'contact.php',
			dataType: 'json',
			cache: false,
			data: $('#contact-form').serialize(),
			success: function(data) {

				if(data.info != 'error'){
					$this.parents('form').find('input[type=text],textarea,select').filter(':visible').val('');
					$('#msg').hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				} else {
					$('#msg').hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				}
			}
		});
	});
});

/* ---------------------------------------------------------------------- */
/*	Isotop reconstruct function
/* ---------------------------------------------------------------------- */
function reconstructIsotope(){
	$('#content').isotope({ 
		animationOptions: {
			duration: 200,
			easing	: 'linear',
			queue	: true,
		}
	});
}

/* ---------------------------------------------------------------------- */
/*	flexslider
/* ---------------------------------------------------------------------- */
function flexslider(){
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 143,
        itemMargin: 0,
        asNavFor: '#slider'
    });
      
    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
        	$('body').removeClass('loading');
        }
    });
}

/* ---------------------------------------------------------------------- */
/*	Get project with id parameter
/* ---------------------------------------------------------------------- */
function get_project(id_project, move){
	move = typeof move !== 'undefined' ? move : false;

	if(move === true){
		$('#loading').animate({'opacity': 1}, 600);
		$('.loader').css('z-index', 99999).animate({'opacity': 1},1);
		$('#single-post').html("");
	}
	$("#single-post").load("projects.html section.slider[data-id="+ id_project +"]", null, function(){
		$('#slider.flexslider img').each(function(){
			$('#carousel.flexslider .slides').append('<li><img src="' + baseurl + 'php/timthumb.php?src=' + baseurl + $(this).attr('src') + '&w=137&h=87&zc=1"></li>');
		});

		$('#single-post').imagesLoaded(function(){
			flexslider();
			$('#single-post').fadeIn(1).animate({'margin-left':0},1000, function(){
				$('#loading').animate({'opacity': 0}, 600);
				$('.loader').animate({'opacity': 0}, 600).css('z-index', 0);
				if(move === false){
					$('#content').animate({'margin-left':'100%'},1000).delay(400).fadeOut(1000);
					$('#single-post').fadeIn(0).animate({'margin-left':0},1000);
					$('header').delay(500).animate({'margin-top':'-80px'});
					$('#filter').fadeOut();
				}
			});
		});
	 });
}