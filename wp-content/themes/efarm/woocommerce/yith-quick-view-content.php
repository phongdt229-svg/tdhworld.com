<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post(); ?>

 <div class="product">

	<div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>

		<?php do_action( 'yith_wcqv_product_image' ); ?>

		<div class="summary entry-summary">
			<div class="summary-content">
				<?php do_action( 'yith_wcqv_product_summary' ); ?>
			</div>
		</div>

	</div>
	<script>
		(function ($) {
			"use strict";
			jQuery(".fancybox-zoomcontainer").fancybox({
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
			$(document).ready(function () {
				if($('form.cart').hasClass('variations_form')){
					// wc_add_to_cart_params is required to continue, ensure the object exists
					if ( typeof wc_add_to_cart_params === 'undefined' )
						return false;
					
					// Ajax add to cart
					$( document ).on( 'click', '.variations_form .single_add_to_cart_button', function(e) {
						
						e.preventDefault();
						
						$variation_form = $( this ).closest( '.variations_form' );
						var var_id = $variation_form.find( 'input[name=variation_id]' ).val();
						
						var product_id = $variation_form.find( 'input[name=product_id]' ).val();
						var quantity = $variation_form.find( 'input[name=quantity]' ).val();
						
						//attributes = [];
						$( '.ajaxerrors' ).remove();
						var item = {},
							check = true;
							
							variations = $variation_form.find( 'select[name^=attribute]' );
							
							/* Updated code to work with radio button - mantish - WC Variations Radio Buttons - 8manos */ 
							if ( !variations.length) {
								variations = $variation_form.find( '[name^=attribute]:checked' );
							}
							
							/* Backup Code for getting input variable */
							if ( !variations.length) {
								variations = $variation_form.find( 'input[name^=attribute]' );
							}
						
						variations.each( function() {
						
							var $this = $( this ),
								attributeName = $this.attr( 'name' ),
								attributevalue = $this.val(),
								index,
								attributeTaxName;
						
							$this.removeClass( 'error' );
						
							if ( attributevalue.length === 0 ) {
								index = attributeName.lastIndexOf( '_' );
								attributeTaxName = attributeName.substring( index + 1 );
						
								$this
									//.css( 'border', '1px solid red' )
									.addClass( 'required error' )
									//.addClass( 'barizi-class' )
									.before( '<div class="ajaxerrors"><p>Please select ' + attributeTaxName + '</p></div>' )
						
								check = false;
							} else {
								item[attributeName] = attributevalue;
							}
						
							// Easy to add some specific code for select but doesn't seem to be needed
							// if ( $this.is( 'select' ) ) {
							// } else {
							// }
						
						} );
						
						if ( !check ) {
							return false;
						}
						
						var $thisbutton = $( this );

						if ( $thisbutton.is( '.variations_form .single_add_to_cart_button' ) ) {

							$thisbutton.removeClass( 'added' );
							$thisbutton.addClass( 'loading' );

							var data = {
								action: 'woocommerce_add_to_cart_variable_rc',
								product_id: product_id,
								quantity: quantity,
								variation_id: var_id,
								variation: item
							};

							// Ajax action
							$.post( wc_add_to_cart_params.ajax_url, data, function( response ) {
	
								if ( ! response )
									return;

								var this_page = window.location.toString();

								this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );
								
								if ( response.error && response.product_url ) {
									window.location = response.product_url;
									return;
								}
								var message_div = $('<div>')
										.attr('id', 'cart_added_msg'),
										popup_div = $('<div>')
										.attr('id', 'cart_added_msg_popup')
										.html(message_div)
										.hide();

								$('body').prepend(popup_div);
								var msg = $('#cart_added_msg_popup');
								$('#yith-quick-view-modal').removeClass('open');
								$('#cart_added_msg').html(apr_params.ajax_cart_added_msg);
								msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();		

								$thisbutton.removeClass( 'loading' );
								window.setTimeout(function () {
									msg.fadeOut();
									$('#mini-scart').removeClass('active_minicart');
								}, 2000);

								var fragments = response.fragments;
								var cart_hash = response.cart_hash;
							});

							return false;

						} else {
							return true;
						}

					});
				}
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
						$('#yith-quick-view-modal').removeClass('open');
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
			});
			
		})(jQuery);
	</script>

</div>

<?php endwhile; // end of the loop.