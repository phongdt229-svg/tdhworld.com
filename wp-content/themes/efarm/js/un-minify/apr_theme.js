(function ($) {
    "use strict";
	function clearSelected() {
	    $('.star-rating a.zero-star').removeClass('zero-selected');
	    $('.star-rating a.one-star').removeClass('current-rating');
	    $('.star-rating a.two-stars').removeClass('current-rating');
	    $('.star-rating a.three-stars').removeClass('current-rating');
	    $('.star-rating a.four-stars').removeClass('current-rating');
	    $('.star-rating a.five-stars').removeClass('current-rating');
	}
	$( ".single-product .info .entry-summary" ).after( '<div class="uni-cpo-total"></div>' );
	$('.apr-comment-rating .star-rating a').each(function(index) {
	    $(this).on("click", function(){
	        var ratedata=$(this).data('rating'); 
	        clearSelected();
	        console.log(ratedata);
	        if(ratedata!='0'){
	        	$(this).addClass('current-rating');
	        }else{
	        	$(this).addClass('zero-selected');
	        }
	        $('.apr-comment-rating #rate').val(ratedata);
	        
	    });
	});	
	var $grid = $('.isotope');
	// filter items on button click
	$('.button-group').on( 'click', 'button', function() {
		var filterValue = $(this).attr('data-filter');
		$grid.isotope({ filter: filterValue });
		$('.button-group button').removeClass('is-checked');
		$(this).addClass('is-checked');
	}); 
	
	var $grid_blog = $('.blog-home');
	// filter items on button click
	$('.blog_filter .button-group').on( 'click', 'button', function() {
		var filterValueBlog = $(this).attr('data-filter');
		$grid_blog.isotope({ filter: filterValueBlog });
		$('.button-group button').removeClass('is-checked');
		$(this).addClass('is-checked');
	});

	var $grid_press = $('.press-entries-wrap');
	// filter items on button click
	$('.press_filter .button-group').on( 'click', 'button', function() {
		var filterValuePress = $(this).attr('data-filter');
		$grid_press.isotope({ filter: filterValuePress });
		$('.button-group button').removeClass('is-checked');
		$(this).addClass('is-checked');
	}); 
	
	$(".product_slide.layout_style_2 .product-name").html(function(){
	  var text= $(this).text().trim().split(" ");
	  var first = text.shift();
	  return (text.length > 0 ? "<span class='text-light'>"+ first + "</span> " : first) + text.join(" ");
	});
	
    //like count gallery
    $('body').on('click', '.apr-post-like', function (event) {
        event.preventDefault();
        var heart = $(this);
        var post_id = heart.data("post_id");
        var like_type = heart.data('like_type') ? heart.data('like_type') : 'post';
        heart.html("<i id='icon-like' class='fa fa-heart-o'></i><i id='icon-spinner' class='fa fa-spinner fa-spin'></i>");
        $.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=apr-post-like&nonce=" + ajax_var.nonce + "&apr_post_like=&post_id=" + post_id + "&like_type=" + like_type,
            success: function (count) {
                if (count.indexOf("already") !== -1)
                {
                    var lecount = count.replace("already", "");
                    if (lecount === " 0")
                    {
                        lecount = " ".apr_params.apr_like_text;
                    }
                    heart.prop('title', apr_params.apr_like_text);
                    heart.removeClass("liked");
                    heart.html("<i id='icon-unlike' class='fa fa-heart-o'></i>" + ' ' + lecount);
                }
                else
                {
                    heart.prop('title', apr_params.apr_unlike_text);
                    heart.addClass("liked");
                    heart.html("<i id='icon-like' class='fa fa-heart-o'></i>" + ' ' + count);
                }
            }
        });
    });	
	// Fix Height menu vertical
	var heightRecipe= $('.recipe-image').height();
	var height = $(window).height();
	var width = $(window).width();
	var heightNav = $('.header-sidebar').height();
	var heightNavMenu = $('.mega-menu').height();
	var heightBlogpackery  = $('.blog-packery.blog-style2 .blog-img').height();
	
	if( heightNav > height ){
		$('.header-ver').addClass('header-scroll');
	}
	if(width < 992){
		if( heightNavMenu > height ){
			$('.header-center').addClass('header-scroll');
		}
	}
	
	if($(window).width() > 991){
		var heightBlog = $('.blog-img').height(); 
		$('.layout-packery .blog-post-info').css('height', heightBlog + 'px'); 
		$('.layout-packery .image_size1 .blog-post-info').css('height', heightBlog + 30 + 'px');
		$('.recipe-gallery .recipe_body').css('height', heightRecipe  + 'px'); 

	}
	if($(window).width() > 1199){
		$('.blog-packery.blog-style2 .blog-post-info').css('height', heightBlog + 'px');

	}
	//Menu double
	if($(window).width() > 991){
		  var item = $('.mega-menu').children('li').length,
		  half = Math.round(item / 2),
		  mid = $('.mega-menu>li:nth-child(' + half + ')'),
		  logo = $('.kad-header-logo'),
		  menu = $('.kad-header-menu');
		  mid.after(logo);
		  menu.css('width', '100%');
	}  		
	// Media product details
    if(!!$.prototype.elevateZoom) {
        $("img.zoom").elevateZoom({ 
			zoomType: "inner", 
			cursor: "crosshair", 
			gallery:'thumbs_list_frame', 
			imageCrossfade: true 
		});
    }
	//Coming-soon date
	$('#getting-started').countdown(apr_params.under_end_date).on('update.countdown', function(event) {
		var $this = $(this);
		if (event.elapsed) {
		  $this.html(event.strftime(''
         + '<div class="coming-timer"><span>%D</span><span>'+apr_params.apr_text_day+'</span></div> '
         + '<div class="coming-timer"><span>%H</span><span>'+apr_params.apr_text_hour+'</span></div>'
         + '<div class="coming-timer"><span>%M</span><span>'+apr_params.apr_text_min+'</span></div>'
         + '<div class="coming-timer"><span>%S</span><span>'+apr_params.apr_text_sec+'</span></div>'
		 + ''));
		} else {
		  $this.html(event.strftime(''
         + '<div class="coming-timer"><span>%D</span><span>'+apr_params.apr_text_day+'</span></div> '
         + '<div class="coming-timer"><span>%H</span><span>'+apr_params.apr_text_hour+'</span></div>'
         + '<div class="coming-timer"><span>%M</span><span>'+apr_params.apr_text_min+'</span></div>'
         + '<div class="coming-timer"><span>%S</span><span>'+apr_params.apr_text_sec+'</span></div>'
		 + ''));
		}
	});
	
	
	//Add class category
	$('.widget_categories ul').each(function(){
		if($(this).hasClass('children')) {
			$(this).parent().addClass('cat-item-parent');
		} 
	});
	
	if($('img').hasClass('lazy')){
		$('#page').addClass('lazy-loading-img');
	}
	//  Slick Slider

    $('.slick-carousel').slick({
      dots: true,
      infinite: true,
      speed: 800,
      slidesToShow: 1,
      adaptiveHeight: true,
      rtl:true,
    });
    
    $('body').on('added_to_cart', function () {
        $("a.added_to_cart").remove();
    });
	
	
    // Vertical Menu Search
	$(".search_button").click(function(){
	  $('.search-holder .searchform_wrap').addClass("opened");
	  $('html').addClass("search_opened");
	  $('.overlay').removeClass('overlay-menu');
	});
	$('.close_search_form').click(function(f){
	  f.preventDefault();
	  $('.search-holder .searchform_wrap').removeClass("opened");
	  $('html').removeClass("search_opened");
	});
	$('.overlay').click(function(f){
	  f.preventDefault();
	  $('.search-holder .searchform_wrap').removeClass("opened");
	  $('html').removeClass("search_opened");
	  $('.overlay').removeClass('overlay-menu');
	});
	
	// Vertical Menu Search
	$(".open-menu").click(function(){
	  $('html').addClass("nav-open");
	  $('.overlay').removeClass('overlay-menu');
	});
	$('.close-menu').click(function(f){
	  f.preventDefault();
	  $('html').removeClass("nav-open");
	});
	$('.overlay').click(function(f){
	  f.preventDefault();
	  $('html').removeClass("nav-open");
	});
		
	// Vertical Menu
	var $bdy = $('html');
	$('.open-menu-mobile').on('click',function(e){
		if($bdy.hasClass('openmenu')) {
		  jsAnimateMenu2('close');
		} else {
		  jsAnimateMenu2('open');
		}
	});
	$('.close-menu-mobile').on('click',function(e){
		if($bdy.hasClass('openmenu')) {
		  jsAnimateMenu2('close');
		} else {
		  jsAnimateMenu2('open');
		}
	});
	
	$('a[href$="#"]').on('click', function(e){
		e.preventDefault();
	});
	
	$('.overlay').click(function () {
		if($('html').hasClass('openmenu')){
			$('html').removeClass('openmenu');
		}
	});
	//category sidebar  
    $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > a");
    var $p = $(".widget_product_categories ul.product-categories > li p");
    $(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) p").append('<span>+</span>');
    $(".widget_product_categories ul.product-categories > li.current-cat p").append('<span>-</span>');
    $(".widget_product_categories ul.product-categories > li.current-cat-parent p").append('<span>-</span>');
    $(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) > ul").hide();

    $(".widget_product_categories ul.product-categories > li").each(function () {
        if ($(this).find("ul > li").length == 0) {
            $(this).find('p').remove();
        }

    });

    $p.click(function () {
        var $accordion = $(this).nextAll('ul');

        if ($accordion.is(':hidden') === true) {

            $(".widget_product_categories ul.product-categories > li > ul").slideUp();
            $accordion.slideDown();

            $p.find('span').remove();
            $p.append('<span>+</span>');
            $(this).find('span').remove();
            $(this).append('<span>-</span>');
        }
        else {
            $accordion.slideUp();
            $(this).find('span').remove();
            $(this).append('<span>+</span>');
        }
    });

	// Menu Lever 2
    $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > a");
    var $pp = $(".widget_product_categories ul.product-categories > li > ul > li p");
    $(".widget_product_categories ul.product-categories > li >ul >li > ul").hide();
    $(".widget_product_categories ul.product-categories > li > ul > li p").append('<span>+</span>');

    $(".widget_product_categories ul.product-categories > li > ul > li").each(function () {
        if ($(this).find("ul > li").length == 0) {
            $(this).find('p').remove();
        }
    });

    $pp.click(function () {
        var $accordions = $(this).nextAll('ul');

        if ($accordions.is(':hidden') === true) {

            $(".widget_product_categories ul.product-categories > li > ul > li > ul").slideUp();
            $accordions.slideDown();

            $pp.find('span').remove();
            $pp.append('<span>+</span>');
            $(this).find('span').remove();
            $(this).append('<span>-</span>');
        }
        else {
            $accordions.slideUp();
            $(this).find('span').remove();
            $(this).append('<span>+</span>');
        }
    });
	
	// Menu Lever 3
	$("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > ul > li > a");
    var $ppp = $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p");
    $(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").hide();
    $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p").append('<span>+</span>');
	
	$(".widget_product_categories ul.product-categories > li > ul > li > ul > li").each(function () {
        if ($(this).find("ul > li").length == 0) {
            $(this).find('p').remove();
        }
    });
	
	$ppp.click(function () {
        var $accordions = $(this).nextAll('ul');

        if ($accordions.is(':hidden') === true) {

            $(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").slideUp();
            $accordions.slideDown();

            $ppp.find('span').remove();
            $ppp.append('<span>+</span>');
            $(this).find('span').remove();
            $(this).append('<span>-</span>');
        }
        else {
            $accordions.slideUp();
            $(this).find('span').remove();
            $(this).append('<span>+</span>');
        }
    });
    
    /*Animation scrollReveal*/
    window.scrollReveal = new scrollReveal({
        mobile: false
    });
  
    $('#commentform .form-submit .submit').addClass("btn btn-primary");
    //remove class
    $( ".megamenu .dropdown-menu.children > li > ul.children" ).removeClass( "dropdown-menu" )
    //woocommerce
    $('body').bind('added_to_cart', function (response) {
        $('body').trigger('wc_fragments_loaded');
    });

    function woocommerce_add_cart_ajax_message() {
    	$('.ajax_add_to_cart').click(function(e){
    		e.preventDefault();
    	});
        if ($('.add_to_cart_button').length !== 0 && $('#cart_added_msg_popup').length === 0) {
            var message_div = $('<div>')
                    .attr('id', 'cart_added_msg'),
                    popup_div = $('<div>')
                    .attr('id', 'cart_added_msg_popup')
                    .html(message_div)
                    .hide();

            $('body').prepend(popup_div);
        }
    }
    woocommerce_add_cart_ajax_message();
    //Woocommerce update cart sidebar
    $('body').bind('added_to_cart', function (response) {
        $('body').trigger('wc_fragments_loaded');
        $('ul.products li .added_to_cart').remove();
        var msg = $('#cart_added_msg_popup');
        $('.mini-cart').addClass('active_minicart');
        $('#cart_added_msg').html(apr_params.ajax_cart_added_msg);
        msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();
        window.setTimeout(function () {
            msg.fadeOut();
            $('.mini-cart').removeClass('active_minicart');
        }, 2000);
    });
	
    // tabs
    $("form.cart").on("change", "input.qty", function() {
        if (this.value === "0")
            this.value = "1";

        $(this.form).find("button[data-quantity]").data("quantity", this.value);
    });	
	
	// Ajax add to cart on the product page
	if(apr_params.apr_woo_enable == 'yes' && apr_params.ajax_cart_single == 1){
		var $warp_fragment_refresh = {
			url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
			type: 'POST',
			success: function( data ) {
				if ( data && data.fragments ) {

					$.each( data.fragments, function( key, value ) {
						$( key ).replaceWith( value );
					});

					$( document.body ).trigger( 'wc_fragments_refreshed' );
				}
			}
		};
		$('.entry-summary form.cart').on('submit', function (e){
			e.preventDefault();
			var $this = $(this);
			$this.block({
				message: null,
				overlayCSS: {
					cursor: 'none'
				}
			});

			var product_url = window.location,
				form = $(this);

			$.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result){
				var cart_dropdown = $('.widget_shopping_cart', result);

				var msg = $('#cart_added_msg_popup');
				$('#mini-scart').addClass('active_minicart');
				$('#cart_added_msg').html(apr_params.ajax_cart_added_msg);
				msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();		        
				// update dropdown cart
				$('.widget_shopping_cart').replaceWith(cart_dropdown);

				// update fragments
				$.ajax($warp_fragment_refresh);

				$this.unblock();
				window.setTimeout(function () {
					msg.fadeOut();
					$('#mini-scart').removeClass('active_minicart');
				}, 2000);		        

			});
		});	
	}
    var h = $(window).height();
    $('.coming-soon-container').css('height', h + 'px');
    $('ul.mega-menu > li.megamenu .menu-bottom').hide();
    $('ul.mega-menu > li.megamenu .menu-bottom').each(function(){
        var className = $(this).parent().parent().attr('id');
            if($(this).hasClass(className)){
                $(this).show();
            }
    });
    $('ul.mega-menu > li.megamenu .menu-block1').hide();
    $('ul.mega-menu > li.megamenu .menu-block1').each(function(){
        var className = $(this).parent().parent().attr('id');
            if($(this).hasClass(className)){
                $(this).show();
            }
    });
    $('ul.mega-menu > li.megamenu .menu-block2').hide();
    $('ul.mega-menu > li.megamenu .menu-block2').each(function(){
        var className = $(this).parent().parent().attr('id');
            if($(this).hasClass(className)){
                $(this).show();
            }
    });
    //Check if Safari
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
        $('html').addClass('safari');
    }
    //Check if MAC
     if(navigator.userAgent.indexOf('Mac')>1){
       $('html').addClass('safari');
     }  
	//product list view mode
	if(apr_params.type_product == 'list-default' || apr_params.type_product == 'grid-default' || apr_params.shop_list != true || apr_params.type_product == ''){
		$('#grid_mode').unbind('click').click(function () {
			var $toggle = $('.viewmode-toggle');
			var $parent = $toggle.parent();
			var $products = $parent.find('ul.products');
			$('.product_types').addClass('product-grid').removeClass('product-list');
			$('.product_archives').addClass('product-grid-wrap').removeClass('product-list-wrap');
			$products.find('li').removeClass('col-md-12 col-sm-12');
			$('this').addClass('active');
			$('#list_mode').removeClass('active');
			if (($.cookie && $.cookie('viewmodecookie') == 'list') || !$.cookie) {
				if ($toggle.length) {
					$products.fadeOut(300, function () {
						$products.addClass('grid').removeClass('list').fadeIn(300);
					});
				}
			}
			if ($.cookie)
				$.cookie('viewmodecookie', 'grid', {
					path: '/'
				});
			return false;
		});

		$('#list_mode').unbind('click').click(function () {
			var $toggle = $('.viewmode-toggle');
			var $parent = $toggle.parent();
			var $products = $parent.find('ul.products');
			$('.product_types').addClass('product-list').removeClass('product-grid');
			$('.product_archives').addClass('product-list-wrap').removeClass('product-grid-wrap');
			$products.find('li').addClass('col-md-12 col-sm-12');
			$(this).addClass('active');
			$('#grid_mode').removeClass('active');
			if (($.cookie && $.cookie('viewmodecookie') == 'grid') || !$.cookie) {
				if ($toggle.length) {
					$products.fadeOut(300, function () {
						$products.addClass('list').removeClass('grid').fadeIn(300);
					});
				}
			}
			if ($.cookie)
				$.cookie('viewmodecookie', 'list', {
					path: '/'
				});
			return false;
		});

		if ($.cookie && $.cookie('viewmodecookie')) {
			var $toggle = $('.viewmode-toggle');
			if ($toggle.length) {
				var $parent = $toggle.parent();
				if ($parent.find('ul.products').hasClass('grid')) {
					$.cookie('viewmodecookie', 'grid', {
						path: '/'
					});
				} else if ($parent.find('ul.products').hasClass('list')) {
					$.cookie('viewmodecookie', 'list', {
						path: '/'
					});
				} else {
					$parent.find('ul.products').addClass($.cookie('viewmodecookie'));
				}
			}
		}
		if ($.cookie && $.cookie('viewmodecookie') == 'grid') {
			var $toggle = $('.viewmode-toggle');
			var $parent = $toggle.parent();
			var $products = $parent.find('ul.products');
			$('.viewmode-toggle #grid_mode').addClass('active');
			$('.product_types').addClass('product-grid').removeClass('product-list');
			$('.product_archives').addClass('product-grid-wrap').removeClass('product-list-wrap');
			$('.viewmode-toggle #list_mode').removeClass('active');
		}
		if ($.cookie && $.cookie('viewmodecookie') == 'list') {
			var $toggle = $('.viewmode-toggle');
			var $parent = $toggle.parent();
			var $products = $parent.find('ul.products');
			$('.viewmode-toggle #list_mode').addClass('active');
			$('.product_types').addClass('product-list').removeClass('product-grid');
			$('.product_archives').addClass('product-list-wrap').removeClass('product-grid-wrap');
			$('.viewmode-toggle #grid_mode').removeClass('active');
		}
		if(apr_params.type_product == 'grid-default' || ( apr_params.shop_list != true && apr_params.type_product == 'only-grid')){
			if ($.cookie && $.cookie('viewmodecookie') == null) {
				var $toggle = $('.viewmode-toggle');
				if ($toggle.length) {
					var $parent = $toggle.parent();
					$parent.find('ul.products').addClass('grid');
					$('.product_types').addClass('product-grid');
					$('.product_archives').addClass('product-grid-wrap');
				}
				$('.viewmode-toggle #grid_mode').addClass('active');
				if ($.cookie)
					$.cookie('viewmodecookie', 'grid', {
						path: '/'
					});
			}
			
		}  
		if(apr_params.type_product == 'list-default' || ( apr_params.shop_list != true && apr_params.type_product == 'only-list')){

			if ($.cookie && $.cookie('viewmodecookie') == null) {
				var $toggle = $('.viewmode-toggle');
				if ($toggle.length) {
					var $parent = $toggle.parent();
					$parent.find('ul.products').addClass('list');
					$('.product_types').addClass('product-list').removeClass('product-grid');
					$('.product_archives').addClass('product-list-wrap').removeClass('product-grid-wrap');
				}
				$('.viewmode-toggle #list_mode').addClass('active');
				if ($.cookie)
					$.cookie('viewmodecookie', 'list', {
						path: '/'
					});
			}
		}      
	}
	$('.btn_togglefilter').on('click', function(e){
        toggleFilter(this);
    });    
    $('.btn-open').on('click', function(e){
        toggleFilter(this);
    });
    $('.btn-search').on('click', function(e){
        toggleFilter(this);
    });
    $('.btn-account').on('click', function(e){
        toggleFilter(this);
    });    
    $('.cart_label').on('click', function(e){
        toggleFilter(this);
    });
    $('.current-open').on('click', function(e){
        toggleFilter(this);
    });


    //quantily
    $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<div class="qty-number"><span class="increase-qty plus" onclick="">+</span></div>').prepend('<div class="qty-number"><span class="increase-qty minus" onclick="">-</span></div>');

    // Target quantity inputs on product pages
    $('input.qty:not(.product-quantity input.qty)').each(function () {
        var min = parseFloat($(this).attr('min'));

        if (min && min > 0 && parseFloat($(this).val()) < min) {
            $(this).val(min);
        }
    });

    $(document).off('click', '.plus, .minus').on('click', '.plus, .minus', function () {

        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
                currentVal = parseFloat($qty.val()),
                max = parseFloat($qty.attr('max')),
                min = parseFloat($qty.attr('min')),
                step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN')
            currentVal = 0;
        if (max === '' || max === 'NaN')
            max = '';
        if (min === '' || min === 'NaN')
            min = 1;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
            step = 1;

        // Change the value
        if ($(this).is('.plus')) {

            if (max && (max === currentVal || currentVal > max)) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }

        } else {

            if (min && (min === currentVal || currentVal < min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }

        }

        // Trigger change event
        $qty.trigger('change');
    });
    if($('input.qty:not(.product-quantity input.qty)').val() < 10){
      $('input.qty:not(.product-quantity input.qty)').val('0'+$('input.qty:not(.product-quantity input.qty)').val());  
    }
    $('input.qty:not(.product-quantity input.qty)').on('change', function() {
        if($(this).val() < 10 && $(this).val() > 0) {
            $(this).val('0'+$(this).val());
        }
    });  
    $('.ult_acord').remove();

    // Viewby
    $( '.woocommerce-viewing' ).off( 'change' ).on( 'change', 'select.count', function() {
        $( this ).closest( 'form' ).submit();
    });
	$(document).on( 'added_to_wishlist removed_from_wishlist', function(){
		var counter = $('.ajax-wishlist');
		$.ajax({
			url: yith_wcwl_l10n.ajax_url,
			data: {
				action: 'yith_wcwl_update_wishlist_count'
			},
			dataType: 'json',
			success: function( data ){
				counter.html( data.count );
			},
			beforeSend: function(){
				counter.block();
			},
			complete: function(){
				counter.unblock();
			}
		})
	} )
	
    //gallery
    var gallery_paged = $('#gallery-loadmore').data('paged');
    var gallery_page = gallery_paged ? gallery_paged + 1 : 2;
    var Gallery = {
        _initialized: false,
        init: function () {
            if (this._initialized)
                return false;
            this._initialized = true;
            this.galleryLoadmore();
        },
        galleryLoadmore: function () {
            $('#gallery-loadmore').click(function (event) {
                event.preventDefault();
                var el = $(this);
                var gallery_wrap = $('.gallery-entries-wrap');
                var url = $(this).attr('href');
                
                $('#gallery-loadmore').after('<i class="fa fa-refresh fa-spin"></i>');
                el.addClass('hide-loadmore');
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {paged: gallery_page},
                    success: function (response) {
                        $('.load-more').find('.fa-spin').remove();
                        el.removeClass('hide-loadmore');
                        var result = $(response).find('.gallery-entries-wrap').html();
                        if ($().isotope) {
                            $(result).imagesLoaded(function () {
                                if (gallery_wrap.data('isotope')) {
                                    gallery_wrap.isotope('insert', $(result));
                                }
                            });
                        }
                        gallery_page++;
                        if (gallery_page > parseInt(el.data('totalpage'))) {
                            el.parent().remove();
                        }
                    }
                });
            });
        }
    };
	
	// Blog Load More
    var blog_paged = $('#blog-loadmore').data('paged');
    var blog_page = blog_paged ? blog_paged + 1 : 2;
    var Blog = {
        _initialized: false,
        init: function () {
            if (this._initialized)
                return false;
            this._initialized = true;
            this.blogLoadmore();
        },
        blogLoadmore: function () {
            $('#blog-loadmore').click(function (event) {
                event.preventDefault();
                var el = $(this);
                var blog_wrap = $('.blog-entries-wrap');
                var url = $(this).attr('href');
                $('.load-more').append('<i class="fa fa-refresh fa-spin"></i>');
                el.addClass('hide-loadmore');
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {paged: blog_page},
                    success: function (response) {
                        $('.load-more').find('.fa-spin').remove();
                        el.removeClass('hide-loadmore');
                        var result = $(response).find('.blog-entries-wrap').html();
						if ($().isotope) {
                            $(result).imagesLoaded(function () {
                                if (blog_wrap.data('isotope')) {
                                    blog_wrap.isotope('insert', $(result));
                                }
                            });
                        }
                        blog_page++;
                        if (blog_page > parseInt(el.data('totalpage'))) {
                            el.parent().remove();
                        }
                    }
                });
            });
        }
    };
	
	// Product Load More
    var Product = {
        _initialized :false,
        init: function(){
            if(this._initialized)
                return false;
            this._initialized = true;
            this.isotopeChangeLayout();
        },
        isotopeChangeLayout : function(){   

            var button = $('[data-isotope-container]');

            button.each(function(){

                var $this = $(this),

                    container = $($this.data('isotope-container')),

                    layout = $this.data('isotope-layout');

                $this.on('click',function(){

                    $(this).addClass('black_button_active').siblings().removeClass('black_button_active').addClass('black_hover');

                    if(layout == "list"){

                        container.children("[class*='isotope_item']").addClass('list_view_type');

                    }

                    else{

                        container.children("[class*='isotope_item']").removeClass('list_view_type');

                    }

                    container.isotope('layout');

                    container.find('.tooltip_container').tooltip('.tooltip').tooltip('.tooltip');

                });

            });

        },

    };
	//knowledge
    var knowledge_paged = $('#knowledge-loadmore').data('paged');
    var knowledge_page = knowledge_paged ? knowledge_paged + 1 : 2;
    var Knowledge = {
        _initialized: false,
        init: function () {
            if (this._initialized)
                return false;
            this._initialized = true;
            this.knowledgeLoadmore();
        },
        knowledgeLoadmore: function () {
            $('#knowledge-loadmore').click(function (event) {
                event.preventDefault();
                var el = $(this);
                var knowledge_wrap = $('.knowledge-entries-wrap');
                var url = $(this).attr('href');
                
                $('#knowledge-loadmore').after('<i class="fa fa-refresh fa-spin"></i>');
                el.addClass('hide-loadmore');
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {paged: knowledge_page},
                    success: function (response) {
                        $('.load-more').find('.fa-spin').remove();
                        el.removeClass('hide-loadmore');
                        var result = $(response).find('.knowledge-entries-wrap').html();
                        if ($().isotope) {
                            $(result).imagesLoaded(function () {
                                if (knowledge_wrap.data('isotope')) {
                                    knowledge_wrap.isotope('insert', $(result));
                                }
                            });
                        }
                        knowledge_page++;
                        if (knowledge_page > parseInt(el.data('totalpage'))) {
                            el.parent().remove();
                        }
                    }
                });
            });
        }
    };

    //Press Media
    var press_paged = $('#press-loadmore').data('paged');
    var press_page = press_paged ? press_paged + 1 : 2;
    var Press = {
        _initialized: false,
        init: function () {
            if (this._initialized)
                return false;
            this._initialized = true;
            this.pressLoadmore();
        },
        pressLoadmore: function () {
            $('#press-loadmore').click(function (event) {
                event.preventDefault();
                var el = $(this);
                var press_wrap = $('.press-entries-wrap');
                var url = $(this).attr('href');
                
                $('#press-loadmore').after('<i class="fa fa-refresh fa-spin"></i>');
                el.addClass('hide-loadmore');
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {paged: press_page},
                    success: function (response) {
                        $('.load-more').find('.fa-spin').remove();
                        el.removeClass('hide-loadmore');
                        var result = $(response).find('.press-entries-wrap').html();
                        if ($().isotope) {
                            $(result).imagesLoaded(function () {
                                if (press_wrap.data('isotope')) {
                                    press_wrap.isotope('insert', $(result));
                                }
                            });
                        }
                        press_page++;
                        if (press_page > parseInt(el.data('totalpage'))) {
                            el.parent().remove();
                        }
                    }
                });
            });
        }
    };    
    function addheightstyle(){
 		var h = $(window).height();
 		$('.page-404').css('height', h + 'px');   	
    }     
//Start ready function
    
    $(window).ready(function() {
    	$('#billing_address_1').val(''); 
    	$('#billing_address_2').val(''); 
    	$('#shipping_address_1').val('');
    	$('#shipping_address_2').val('');
    	$('.print_direction').click(function(){
    		$(".recipe_direction").printThis();
    	});
		$(".fancybox").on("click", function () {
            $(this).fancybox({
                href: this.href,
                type: $(this).data("type")
            }); // fancybox
            return false;
        }); // on
		$(".fancybox-zoomcontainer").fancybox({
			helpers : {
			  title : {
			   type : 'inside'
			  },
			  buttons : {},
			  thumbs : {
			   width : 50,
			   height : 50
				}
			},
			afterShow: function() {
		        $('.zoomContainer').remove();
		        $('img.fancybox-image').elevateZoom({ 
		            zoomType: "inner",
		            cursor: "crosshair",
		            zoomWindowFadeIn: 500,
		            zoomWindowFadeOut: 750
		        });
		    },
		    afterClose: function() {
		        $('.fancybox-overlay + .zoomContainer').remove();
				$('img.zoom').elevateZoom({ 
		            zoomType: "inner",
		            cursor: "crosshair",
		            zoomWindowFadeIn: 500,
		            zoomWindowFadeOut: 750
		        });		        
		    }
		});	        
        $('.iframe_fancybox').fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'elastic',
			closeEffect	: 'none'
		});	
        var wdw = $(window).width();
        if(wdw > 767){
            var ff_height2 = $('.ff_height2 .vc_column-inner').height();
            $('.ff_height1 .vc_column-inner').height(ff_height2);
        }  
        
		var filterValueProduct = $('.active_cat').attr('data-filter'); 
        var container = $('.isotope').isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows',
			filter: filterValueProduct,
            getSortData: {
                name: '.item'
            }
        });
        $('.btn-filter').on( 'click', '.button', function() {
            var filterValue = $(this).attr('data-filter');
            container.isotope({ filter: filterValue });
        });
        $('.btn-filter').each( function( i, buttonGroup ) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on( 'click', '.button', function() {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });
        $('.grid').isotope({
          itemSelector: '.grid-item',
          percentPosition: true
        })
		
		$('.cate-menu .title-cate').on('click', function() {
			$(this).toggleClass('active');
			$('.cate-menu .product-categories').slideToggle();
		});

		// Instagram Fix Height
		var heightIns = $('.instagram-type1').height();
		$('.instagram-type1 .title-insta').css('height', heightIns + 120 + 'px' );
		
		// Submenu
		$(".mega-menu .caret-submenu").on('click', function(e){
		   $(this).toggleClass('active');
		   $(this).siblings('.sub-menu').toggle(300);
		});
		
		//Tooltip
        $('[data-toggle="tooltip"]').tooltip();
		
		// Preloader
		$('.preloader').delay(1200).fadeOut();
		
		// Fancybox

		$(".fancybox-thumb").fancybox({
			prevEffect	: 'none',
			nextEffect	: 'none',
			helpers	: {
				title	: {
					type: 'outside'
				},
				thumbs	: {
					width	: 70,
					height	: 50
				}
			}
		});
		$(".fancybox-thumb-member").fancybox({
			prevEffect	: 'none',
			nextEffect	: 'none',
			helpers	: {
				title	: {
					type: 'outside'
				},
				thumbs	: {
					width	: 70,
					height	: 50 
				}
			}
		});
		
		// Fix height blog
		// if($(window).width() > 767){
		// 	var heightBlog = $('.blog-img').height();
		// 	$('.blog-video').css('height', heightBlog + 'px');  
		// }
		
		var heightHeader = $('.site-header').height();
		var heightFooter = $('footer').height();
		if($(window).width() < 992){
			if($('.site-header').hasClass('header-bottom')){
				$('footer').css('margin-bottom', heightHeader + 'px');
			}
		}
		if($(window).width() > 767){
			if($('.footer').hasClass('footer-fixed')){
				$('#page').css('padding-bottom', heightFooter + 'px');
			}
		}
		
		if($('header').hasClass('menu-mobile') || $('header').hasClass('header-bottom')){
			$('.open-menu-mobile').on('click', function(){
				$('.overlay').css('display', 'none');
			});
			$('.open-menu').on('click', function(){
				$('.overlay').css('display', 'block');
			})
		}
		
        var color = $('.ultsl-stop').css("color");
        $('.ultsl-stop').css('background',color);

        $("a.grouped_elements").fancybox();
        $('img').hover(function(e){
            $(this).data("title", $(this).attr("title")).removeAttr("title");
        });    
        $("a.cart_label").click(function(event){
            event.preventDefault();
        }); 
        
        //validate form
        $('#commentform').validate();
		
        //animation
        $('.animated').appear(function() {
            var item = $(this);
            var animation = item.data('animation');
            if ( !item.hasClass('visible') ) {
                var animationDelay = item.data('animation-delay');
                if ( animationDelay ) {
                    setTimeout(function(){
                        item.addClass( animation + " visible" );
                    }, animationDelay);
                } else {
                    item.addClass( animation + " visible" );
                }
            }
        });
		
        //One page
        $('a[href*="#"]:not([href="#"]).scroll-down ,a[href*="#"]:not([href="#"]).scroll-to-bottom ').click(function(){
			$('a[href*="#"]:not([href="#"]).scroll-down ,a[href*="#"]:not([href="#"]).scroll-to-bottom').removeClass('active');
			$(this).addClass('active');
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
				|| location.hostname == this.hostname) {
				var target = $(this.hash),           
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				   
				if (target.length){
					$('html,body').animate({
					  scrollTop: target.offset().top - 80
					}, 500);
					return false;
				}
			}
        });	
		
		//Ajax search
		$( ".woosearch-search:not(.recipe-search)" ).each(function() {
			$(this).find('.woosearch-search-input').on('change paste keyup ', function (e) {
		        var $that = $(this);
		        var raw_data = $that.val(), // item container
		            category = $("#searchtype").val(),
		            number = $that.data("number"),
		            keypress = $that.data("keypress");
		            
		            if(typeof category == 'undefined'){
		                category = '';
		            }
		        if(raw_data.length >= keypress ){
		            $.ajax({
		                url: apr_params.ajax_url,
		                type: 'POST',
		                data: {action:'woosearch_search',raw_data: raw_data,category:category,number:number},
		                beforeSend: function(){
		                    if ( !$('.woosearch-search:not(.recipe-search) .fa-spin .fa-spinner').length ){
		                        $('.woosearch-search:not(.recipe-search) .fa-spin').addClass('spinner');
		                        $('<i class="fa fa-spinner fa-spin"></i>').appendTo( ".woosearch-search:not(.recipe-search) .fa-spin" ).fadeIn(100);
		                       // $('#moview-search .search-icon .themeum-moviewsearch').remove();
		                    }
		                },
		                complete:function(){
		                    $('.woosearch-search:not(.recipe-search) .fa-spin .fa-spinner ').remove();    
		                    $('.woosearch-search:not(.recipe-search) .fa-spin').removeClass('spinner');
		                }
		            })
		            .done(function(data) {
		                //console.log( data );
		                if(e.type == 'blur') {
		                   $( ".woosearch-results" ).html('');
		                }else{
		                    $( ".woosearch-results" ).html( data );
		                }
		            })
		            .fail(function() {
		                console.log("fail");
		            });
		        }else{
					$( ".woosearch-results" ).html('');
				}
		    });
		});
	    $( ".woosearch-search.recipe-search" ).each(function() {
			$(this).find('.recipe-search-input').on('blur change paste keyup ', function (e) {
		        var $that = $(this);
		        var raw_data = $that.val(), // item container
		            category = $("#searchtype").val(),
		            number = $that.data("number"),
		            keypress = $that.data("keypress");
		            
		            if(typeof category == 'undefined'){
		                category = '';
		            }
		        if(raw_data.length >= keypress ){
		            $.ajax({
		                url: apr_params.ajax_url,
		                type: 'POST',
		                data: {action:'recipe_search',raw_data: raw_data,category:category,number:number},
		                beforeSend: function(){
		                    if ( !$('.woosearch-search.recipe-search .fa-spin .fa-spinner').length ){
		                        $('.woosearch-search.recipe-search .fa-spin').addClass('spinner');
		                        $('<i class="fa fa-spinner fa-spin"></i>').appendTo( ".woosearch-search.recipe-search .fa-spin" ).fadeIn(100);
		                       // $('#moview-search .search-icon .themeum-moviewsearch').remove();
		                    }
		                    
		                },
		                complete:function(){
		                    $('.woosearch-search.recipe-search .fa-spin .fa-spinner ').remove();    
		                    $('.woosearch-search.recipe-search .fa-spin').removeClass('spinner');
		                }
		            })
		            .done(function(data) {
		                //console.log( data );
		                if(e.type == 'blur') {
		                   $( ".recipesearch-results" ).html('');
		                }else{
		                    $( ".recipesearch-results" ).html( data );
		                }
		            })
		            .fail(function() {
		                console.log("fail");
		            });
		        }
		    });
	    });	

	    //wishlist	        
        if(typeof yith_wcwl_l10n != 'undefined') {
            var update_wishlist_count = function() {
                var data = {
                    action: 'update_wishlist_count'
                };
                $.ajax({
                    type: 'POST',
                    url: yith_wcwl_l10n.ajax_url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {

                    },
                    success   : function (data) {
                        $('a.update-wishlist span').html('('+data+')');
                    }
                });
            };

            $('body').on( 'added_to_wishlist removed_from_wishlist', update_wishlist_count );
        }
		$('#thumbs_list_frame .view-img').each(function(){
    		$(this).click(function(){
    		var img_src= $(this).data( "image-zoom" );
    		console.log(img_src);
    		$('.woocommerce-product-gallery__image > .fancybox-zoomcontainer').attr('href',img_src);
    		});

    	});
		$(".fancybox-zoomcontainer").fancybox({
			helpers : {
			  title : {
			   type : 'inside'
			  },
			  buttons : {},
			  thumbs : {
			   width : 50,
			   height : 50
				}
			},
			afterShow: function() {
		        // $('.zoomContainer').hide();
		        // $('img.fancybox-image').elevateZoom({ 
		        //     zoomType: "inner",
		        //     cursor: "crosshair",
		        //     gallery:'thumbs_list_frame',
		        //     zoomWindowFadeIn: 500,
		        //     zoomWindowFadeOut: 750,
		        //     responsive: true,
		        // });
		    },
		    afterClose: function() {
		        // $('.fancybox-overlay + .zoomContainer').remove();
		        // $('.zoomContainer').show();	        
		    }
		});        
        Gallery.init();
        Product.init();
        Blog.init();
        Knowledge.init();
        Press.init();
        addheightstyle();
        bannerheight();

    });
    $('.woosearch-search').on('submit', function (e) {
        if( $(this).data('redirect') == 1 ){
            e.preventDefault();    
        }
    });	
    $(window).load(function() { 
		
        /* Filter isotop */
		var $grid = $('.isotope');
		var container = $('.isotope').isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.item'
            }
        });
		$('.btn-filter').each( function( i, buttonGroup ) {
            var filterLoadValue = $(this).find('.active').attr('data-filter');
            container.isotope({ filter: filterLoadValue });
        });
		var container = $('.product_layout_packery .isotope').isotope({
            itemSelector: '.item',
            layoutMode: 'packery',
            getSortData: {
                name: '.item'
            }
        });
		/* Filter isotop Gallery*/
		var container = $('.isotope.gallery-masonry').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: '.item'
            }
        });
		
		$('.grid-isotope').isotope({
			temSelector: '.grid-item',
			layoutMode: 'fitRows',
            getSortData: {
                name: '.grid-item'
            }
		});
        var container = $('.isotope.layout_masonry').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: '.item'
            }
        });	
		var container = $('.isotope.layout_packery').isotope({
            itemSelector: '.item',
            layoutMode: 'packery',
            getSortData: {
                name: '.item'
            }
        });     
		/* Filter isotop Blog*/
		$('.grid-isotope.blog-masonry').isotope({
			itemSelector: '.grid-item',
			layoutMode: 'masonry',
			masonry: {
				columnWidth: '.grid-item'
			}
		});
		
		$('.grid-isotope.blog-packery').isotope({
			itemSelector: '.grid-item',
			layoutMode: 'packery',
            getSortData: {
                name: '.grid-item'
            }
		});
		/* Filter isotop Press Media*/
		var filterValue = $('.active_cat').attr('data-filter');
		$('.grid-isotope.press-grid').isotope({
			itemSelector: '.item',
			filter: filterValue,
			layoutMode: 'fitRows',
			masonry: {
				columnWidth: '.item'
			}
		});
		$('.grid-isotope.press-masonry').isotope({
			itemSelector: '.item',
			filter: filterValue,
			layoutMode: 'masonry',
			masonry: {
				columnWidth: '.item'
			}
		});
		
        $('.btn-filter').on( 'click', '.button', function() {
            var filterValue = $(this).attr('data-filter');
            container.isotope({ filter: filterValue });
        });
		
        $('.btn-filter').each( function( i, buttonGroup ) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on( 'click', '.button', function() {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });
		
		// instagram parkery
		$('.instagram_parkery').isotope({
          layoutMode: 'packery',
          itemSelector: '.instagram-content',
          percentPosition: true,
            getSortData: {
                name: '.instagram-content'
            },
            transitionDuration:"0.7s",
            masonry : {
                columnWidth:".instagram-content"
            }
        });
		//Scroll to top
        var wd = $(window).width();
        if ($('.scroll-to-top').length) {
            $(window).scroll(function () {
                if ($(this).scrollTop() > $('#page .site-header').height() +40) {
					if($('header').hasClass('header-bottom')){
						$('.scroll-to-top').css({bottom: "90px"});
					}else{
						$('.scroll-to-top').css({bottom: "25px"});
					}
                    if(apr_params.header_sticky_mobile != 1){
                        if(wd > 991){
                            if(apr_params.header_sticky == 1) {
                                $('html:not(.nav-open) .site-header').addClass("is-sticky");
                            }
                        } 
                    }else{
                        if(apr_params.header_sticky == 1) {
                            $('html:not(.nav-open) .site-header').addClass("is-sticky");
                            $('.not-found .site-header').removeClass("is-sticky");
                        }else{
                            $('.not-found .site-header').removeClass("is-sticky");
                        }
                    }
                } else {
                    $('.scroll-to-top').css({bottom: "-100px"});
                    $('.site-header').removeClass("is-sticky");
                    $('.not-found .site-header').addClass("none-sticky");
                }
				
                if ($(this).scrollTop() > 500) {
                    $('.slide-section').addClass("active");
                }
                else {
                    $('.slide-section').removeClass("active");
                }
            });

            $('.scroll-to-top').click(function () {
                $('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
            // $('.scroll-to-bottom').click(function () {
            //      $("html, body").animate({ scrollTop: $(document).height() }, 800);
            //     return false;
            // });
        }
        $(document).ready(function ($) {
			//Up to top
			$('.to-top').click(function () {
				$('html, body').animate({scrollTop: '0px'}, 800);
				return false;
			});
			
			var wd = $(window).width();
			$('.thumbs_list').slick({
				nextArrow: '<button class="btn-prev"><span class="pe-7s-angle-down" aria-hidden="true"></span></button>',
				prevArrow: '<button class="btn-next"><span class="pe-7s-angle-up" aria-hidden="true"></span></button>',
				slidesToShow: 3,
				slidesToScroll: 3,
				dots: false,
				arrows: true,
				vertical: true,
				infinite: true,
				speed: 300,
				responsive: [
					{
					  breakpoint: 1024,
					  settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					  }
					},
					{
					  breakpoint: 600,
					  settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					  }
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				  ]
			});
			$(".thumbs_list a.view-img").click(function(event){
				event.preventDefault();
			});
        });     
		bannerheight();	
		if($('body').hasClass('single-product')){
			if($('.col-md-3').hasClass('left-sidebar') || $('.col-md-3').hasClass('right-sidebar')){
				$('.add-to').addClass('fix-bt-wishlist')
			}
		}
    });
    // Redirect On off	
    $(window).resize(function () {
		addheightstyle();
		bannerheight();
		var heightHeader = $('.site-header').height();
		var heightFooter = $('footer').height();
		if($(window).width() < 992){
			if($('.site-header').hasClass('header-bottom')){
				$('footer').css('margin-bottom', heightHeader + 'px');
			}
		}
		if($('header').hasClass('header-v9')){
			var heightHeader = $('.header-v9').height();
			var heightWd = $(window).height();
			$('.banner-type6 .banner-img').css('height', (heightWd - heightHeader) + 'px' );
		}
		if($(window).width() > 767){
			if($('.footer').hasClass('footer-fixed')){
				$('#page').css('padding-bottom', heightFooter + 'px');
			}
		}
		//Menu double
		if($(window).width() > 991){
			  var item = $('.mega-menu').children('li').length,
			  half = Math.round(item / 2),
			  mid = $('.mega-menu>li:nth-child(' + half + ')'),
			  logo = $('.kad-header-logo'),
			  menu = $('.kad-header-menu');
			  mid.after(logo);
			  menu.css('width', '100%');
		}  
		// Instagram fix height
		var heightIns = $('.instagram-type1').height();
		$('.instagram-type1 .title-insta').css('height', heightIns + 120 + 'px' );
		
		// Fix height header vertical
		var height = $(window).height();
		var width = $(window).width();
		var heightNav = $('.header-sidebar').height();
		var heightNavMenu = $('.mega-menu').height();
		
		if( heightNav > height ){
			$('.header-ver').addClass('header-scroll');
		}
		if(width < 992){
			if( heightNavMenu > height ){
				$('.header-center').addClass('header-scroll');
			}
		}
		
        var hfooter = $('.side-breadcrumb').height();
        var h = $(window).height();
        $('.coming-soon-container').css('height', h + 'px');
         $('.adapt-height .vc_column-inner').css('height', h + 'px'); 
		if(width > 767){
			var heightBlog = $('.blog-img').height();
			$('.blog-video').css('height', heightBlog + 'px'); 
			
		}
        if(width > 991){
            var left_ser = $('.page-home-4 .left-services').height();
            $('.page-home-4 .right-services').height(left_ser);
			var heightBlog = $('.blog-img').height();
			$('.layout-packery .blog-post-info').css('height', heightBlog + 'px'); 
			$('.layout-packery .image_size1 .blog-post-info').css('height', heightBlog + 30 + 'px'); 
        }        
    });
	
})(jQuery);
function bannerheight(){
	var target = jQuery('.banner-content');
	var tab = jQuery('.ult_tab_min_contain');
	jQuery('.ult-box .ult-content-box').each(function(){
		var height = jQuery(this).find(tab).height() + 50;
		jQuery(this).find(target).animate({ height: height }, 600);
		jQuery(this).find('.ult_tabcontent').css('min-height',height);	
	});
}
function jsAnimateMenu1(tog) {
			if(tog == 'open') {
			  jQuery('html').addClass('openmenu openmenu-hoz');
			}
			if(tog == 'close') {
			  jQuery('html').removeClass('openmenu openmenu-hoz');
			}
		}
function jsAnimateMenu2(tog) {
			if(tog == 'open') {
			  jQuery('html').addClass('openmenu');
			}
			if(tog == 'close') {
			  jQuery('html').removeClass('openmenu');
			}
		}		
// Active Cart, Search
function toggleFilter(obj){
    if(jQuery(window).width() < 1199){
		if(jQuery(obj).parent().find('> .content-filter').hasClass('active')){
			jQuery(obj).parent().find('> .content-filter').removeClass('active');  
			jQuery(obj).removeClass('btn-active');                         
		}else{
			jQuery('.btn-open,.cart_label,.btn-search, .btn-account, .languges-flags > a').removeClass('btn-active');
			jQuery('.content-filter').removeClass('active');
			jQuery(obj).parent().find(' > .content-filter').addClass('active');   
			jQuery(obj).addClass('btn-active');           
		}
    }
}

// Add class IE
var ms_ie = false;
var ua = window.navigator.userAgent;
var old_ie = ua.indexOf('MSIE ');
var new_ie = ua.indexOf('Trident/');
if ((old_ie > -1) || (new_ie > -1)) {
	ms_ie = true;
}
if ( ms_ie ) {
   jQuery('body').addClass('ie-11');
}

//Check if Safari
function isSafari() {
  return /^((?!chrome).)*safari/i.test(navigator.userAgent);
}
//Check if MAC
if(navigator.userAgent.indexOf('Mac')>1){
   jQuery('html').addClass('macbook');
}

function menu_tab(evt, tabTitle) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabTitle).style.display = "block";
    evt.currentTarget.className += " active";
}
if(document.getElementById("defaultOpen")){
 // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();   
}
function is_Rirefox(){
 return /^((?!firefox).)*firefox/i.test(navigator.userAgent);
}
if(navigator.userAgent.indexOf('Firefox') > -1) {
    jQuery('body').addClass('firefox');
}