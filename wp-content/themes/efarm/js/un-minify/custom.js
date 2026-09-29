(function ($) {
    "use strict";
    $(document).ready(function () {
		if(apr_params.apr_product_categories == '1'){
			$('.cate-archive').slick({
				prevArrow: '<button class="btn-prev"><i class="fa fa-angle-left"></i></button>',
				nextArrow: '<button class="btn-next"><i class="fa fa-angle-right"></i></button>', 
				slidesToShow: apr_params.apr_number_cate,
				slidesToScroll: 1,
				dots: false,
				arrows: true,
				infinite: true,
				speed: 300,
				responsive: [
					{
					  breakpoint: 1024,
					  settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					  }
					},
					{
					  breakpoint: 600,
					  settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					  }
					},
					{
					  breakpoint: 480,
					  settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					  }
					}
				]
			});
		}
		
        $('.blog-gallery').slick({         
          dots: true,
          arrows: false,
          nextArrow: '<button class="btn-prev"><span class="pe-7s-angle-left"></span></button>',
          prevArrow: '<button class="btn-next"><span class="pe-7s-angle-right"></span></button>',
          infinite: true,
          autoplay: false,
          autoplaySpeed: 2000,
          slidesToShow: 1,
          slidesToScroll: 1
        });
        $('.recipe-gallery').slick({         
          dots: false,
          arrows: true,
          nextArrow: '<button class="btn-prev"><span class="pe-7s-angle-left"></span></button>',
          prevArrow: '<button class="btn-next"><span class="pe-7s-angle-right"></span></button>',
          infinite: true,
          autoplay: false,
          autoplaySpeed: 2000,
          slidesToShow: 1,
          slidesToScroll: 1
        });
		$('.gallery-slide').slick({         
		  dots: false,
		  nextArrow: '<button class="btn-prev"><span class="lnr lnr-arrow-left"></span></button>',
		  prevArrow: '<button class="btn-next"><span class="lnr lnr-arrow-right"></span></button>',
		  infinite: true,
		  autoplay: false,
		  autoplaySpeed: 2000,
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  responsive: [
		  		{
				  breakpoint: 1199,
				  settings: {
					slidesToShow: 3,
				  }
				},
				{
				  breakpoint: 991,
				  settings: {
					slidesToShow: 2,
				  }
				},
				{
				  breakpoint: 550,
				  settings: {
					slidesToShow: 1,
				  }
				}
				
			  ]
		});
        if(apr_params.apr_coming_subcribe_text){
            if(apr_params.apr_coming_subcribe_text.trim() && apr_params.apr_coming_subcribe_text.length > 0){
                $('.page-coming-soon .mc4wp-form input[type="submit"]').attr("value", apr_params.apr_coming_subcribe_text);
            }
        }        
    });
	
})(jQuery);
// Active Cart, Search