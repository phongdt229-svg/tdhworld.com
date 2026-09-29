<?php
/**
* Plugin Name: ArrowPress Importer
* Description: ArrowPress One click demo import 
* Plugin URI: https://arrowtheme.com/
* Version: 1.1.1
* Author: AHT
* Author URI: https://arrowtheme.com/
* License: MIT License
* Text Domain: apr-importer
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');


define('ARROWPRESS_IMPORTER_URL', plugin_dir_url(__FILE__));
// require_once( 'inc/functions.php' );
require_once( 'one-click-demo-import/one-click-demo-import.php' );


/** Enqueue admin style file for import page */
add_action('admin_enqueue_scripts', 'arrowpress_importer_enqueue'); 
function arrowpress_importer_enqueue() {
  	wp_enqueue_style('arrowpress_importer_style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}

/**
 * Import file setup
 */
if ( ! function_exists( 'arrowpress_importer_files' ) ) {  
	function arrowpress_importer_files() {
		$demo_link = 'demo.arrowtheme.com/efarm/'; 
	  	return array(
			array(
				'import_file_name'             => 'Base Content',
				'categories'                   => array( 'Base Content'),
				'local_import_file'            => plugin_dir_path( __FILE__ ) .'data/content.xml',
				'local_import_widget_file'     => plugin_dir_path( __FILE__ ) .'data/widgets.wie',
				'local_import_customizer_file' => plugin_dir_path( __FILE__ ) .'data/customize.json',
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/base.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
			),
			array(
				'import_file_name'             => 'Home 1',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home1.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-1',
			), 
			array(
				'import_file_name'             => 'Home 2',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home2.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-2',
			), 
			array(
				'import_file_name'             => 'Home 3',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home3.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-3',
			),  
			array(
				'import_file_name'             => 'Home 4',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home4.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-4',
			), 
			array(
				'import_file_name'             => 'Home 5',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home5.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-5',
			), 	
			array(
				'import_file_name'             => 'Home 6',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home6.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-6',
			), 	
			array(
				'import_file_name'             => 'Home 7',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home7.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-7',
			), 
			array(
				'import_file_name'             => 'Home 8',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home8.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-8',
			),
			array(
				'import_file_name'             => 'Home 9',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home9.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-9',
			), 
			array(
				'import_file_name'             => 'Home 10',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home10.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-10',
			), 
			array(
				'import_file_name'             => 'Home 11',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home11.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-11',
			), 
			array(
				'import_file_name'             => 'Home 12',
				'categories'                 => array( 'Home Demos'),
				'import_preview_image_url'     => trailingslashit( ARROWPRESS_IMPORTER_URL ) .'assets/images/home12.jpg',
				'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arrowpress_importer' ),
				'preview_url'                => $demo_link.'home-12',
			), 
		);
	}
	add_filter( 'ocdi/import_files', 'arrowpress_importer_files' );
}


/**
 * Steps after importing content: 
 * 
 * - Set menu location
 * - Import theme options
 * - Set front page & blog page
 * - Import slider
 */
if ( ! function_exists( 'arrowpress_importer_after_import' ) ) {
	function arrowpress_importer_after_import( $selected_import ) {
    	global $wp_filesystem, $apr_demo_list;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}	
		$chosen_template = $selected_import['import_file_name'];
		
		//Set Main Menu
		$main_menu = get_term_by( 'name', 'Menu Primary', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		); 
	
		// Assign front, blog and WooCommerce pages.
		$home = get_page_by_path('home');
		$blog = get_page_by_path('blog');

		// Override home and blog pages according to demo ID
		$home = get_page_by_title($apr_demo_list[$selected_import]['home']);
		
		// Delete duplicates
		$pages2 = array('cart','checkout','my-account','wishlist'); 
		foreach ($pages2 as $p2) {
			$p = get_page_by_path($p2 . '-2');
			if ($p) {
				wp_delete_post( $p->ID, true);
			}
		}
		// Get Shop page
		$shop2 = get_page_by_path('shop-2');
		if ($shop2) {
			$shop1 = get_page_by_path('shop');
			wp_delete_post( $shop1->ID, true);
			wp_update_post([
				'post_name' => 'shop',
				'ID' => $shop2->ID,
			]);
		}

		$shop = get_page_by_path('shop');
		$cart = get_page_by_path('cart');
		$checkout = get_page_by_path('checkout');
		$wishlist = get_page_by_path('wishlist');
		$myaccount = get_page_by_path('my-account');
		
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
		update_option( 'page_for_posts', $blog->ID );
		
		update_option( 'woocommerce_myaccount_page_id', $myaccount->ID );
		update_option( 'woocommerce_shop_page_id', $shop->ID );
		update_option( 'woocommerce_cart_page_id', $cart->ID );
		update_option( 'woocommerce_checkout_page_id', $checkout->ID );
		update_option( 'general-show_notice', '');

		// Yith Wishlist
		if ( class_exists( 'YITH_WCWL_Frontend' ) )  {
			update_option( 'yith_wcwl_wishlist_page_id', $wishlist->ID );
		}
		
		if ( class_exists( 'YITH_Woocompare_Frontend' ) )  {
			update_option( 'yith_woocompare_compare_button_in_product_page', 'no' );
			update_option( 'yith_woocompare_compare_button_in_products_list', 'yes' );
		}

		if ( 'Base Content' === $selected_import['import_file_name'] ) {

			//Set Main Menu
			$main_menu = get_term_by( 'name', 'Menu Primary', 'nav_menu' );
			set_theme_mod( 'nav_menu_locations', array(
					'primary' => $main_menu->term_id,
				)
			); 

			
			echo 'Delete Default Post and Page \n';

			/** Delete Hello Post */
			wp_delete_post( 1, true );

			/** Delete "Sample Page" Page */
			wp_delete_post( 2, true );

			// /*Widgets*/
			// $widgets_file = ARROWPRESS_IMPORTER_URL . 'data/widget_data.json';
			// echo $widgets_file;
			// // if ( file_exists( $widgets_file ) ) {
			// 	echo 'file exits';
			//     $encode_widgets_array = $wp_filesystem->get_contents( $widgets_file );
			//     arrowpress_import_widgets( $encode_widgets_array );
			//     print_r($encode_widgets_array);
			// // }	
			
		}elseif('Home 1' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home1/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 1' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home1/home-1.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 2' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home2/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 2' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home2/home-2.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 3' === $selected_import['import_file_name']){
			//Theme Options    
			ob_start();
			include('data/home3/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			echo "Set Front Page \n";	
			$front_page = get_page_by_title( 'Home 3' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}	
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home3/home-3.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
			
		}elseif('Home 4' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home4/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 4' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home4/home-4.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = $slider_popup = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
			
		}elseif('Home 5' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home5/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 5' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home5/home-5.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 6' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home6/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 6' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home6/home-6.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 7' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home7/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 7' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home7/home-7.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 8' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home8/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 8' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home8/home-8.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 9' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home9/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 9' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home9/home-9.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 10' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home10/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 10' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home10/home-6.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 11' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home11/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 11' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home11/home-11.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}elseif('Home 12' === $selected_import['import_file_name']) {
			//Theme Options    
			ob_start();
			include('data/home12/theme_options.php');
			$theme_options = ob_get_clean();

			$options = json_decode($theme_options, true);
			if(class_exists('ReduxFrameworkInstances')){
                $redux = ReduxFrameworkInstances::get_instance('apr_settings');
            }elseif (class_exists( 'Redux_Instances')){
                $redux = Redux_Instances::get_instance('apr_settings');
            }
			$redux->set_options($options);
			apr_save_theme_settings();
			//front page
			$front_page = get_page_by_title( 'Home 12' );
			if ( isset( $front_page->ID ) ) {
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'show_on_front', 'page' );
			}

			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}  
			if ( class_exists( 'RevSlider' ) ) {
				$main_slider = plugin_dir_path( __FILE__ ) . '/data/home12/home-12.zip';

				if ( file_exists( $main_slider ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $main_slider );
				}
			} 
		}
    }
	add_action( 'ocdi/after_import', 'arrowpress_importer_after_import' );
}


/** Echo text before importing widget in log file */
if ( ! function_exists( 'arrowpress_importer_before_widgets_import' ) ) {
	function arrowpress_importer_before_widgets_import( $selected_import ) {
		echo "Import Widget";
	}
	add_action( 'ocdi/before_widgets_import', 'arrowpress_importer_before_widgets_import' );
}

/**
 * Changing Import Page slug
 */
if ( ! function_exists( 'arrowpress_importer_plugin_page_setup' ) ) {
	function arrowpress_importer_plugin_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'themes.php';
		$default_settings['page_title']  = esc_html__( 'ArrowPress Importer' , 'apr-importer' );
		$default_settings['menu_title']  = esc_html__( 'Import Demo Content' , 'apr-importer' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'arrowpress-importer';

		return $default_settings;
	}
	add_filter( 'ocdi/plugin_page_setup', 'arrowpress_importer_plugin_page_setup' );
}

add_filter( 'ocdi/disable_pt_branding', '__return_true' );

// Increase PHP max execution time. Just in case, even though the AJAX calls are only 25 sec long.
$disabled = explode(',', ini_get('disable_functions'));
if( !ini_get('safe_mode') && !in_array('set_time_limit', $disabled) ) {
	set_time_limit( apply_filters( 'ocdi/set_time_limit_for_demo_data_import', 900 ) );
}

function arrowpress_importer_change_time_of_single_ajax_call() {
    return 180;
}
add_filter( 'ocdi/time_for_one_ajax_call', 'arrowpress_importer_change_time_of_single_ajax_call' );