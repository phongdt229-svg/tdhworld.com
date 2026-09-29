<?php
/**
 * Adds arrowpress_instagram_feed widget.
 */
class arrowpress_social extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'arrowpress_instagram_feed', // Base ID
			__( 'Arrowpress Instagram Feed', 'arrowpress-core' ), // Name
			array( 'description' => __( 'Arrowpress Instagram Feed', 'arrowpress-core' ), ) // Args
		);
		add_shortcode( 'arrowpress_instagram_feed', array( $this, 'arrowpress_shortcode_instagram' ) );
	}

	function loadJs() {
		wp_enqueue_script( 'arrowpress_instagram', get_template_directory_uri() . '/inc/widgets/social-widget/instagram/js/instagramfeed.js', array(), false, false );
	}

	public function get_tweets( $number_tweets ) {
		# Define constants
		$options             = get_option( 'arrowpress_latest_tweet' );
		$username            = $options['username'];
		$consumer_key        = $options['consumer_key'];
		$consumer_secret     = $options['consumer_secret'];
		$access_token        = $options['access_token'];
		$access_token_secret = $options['access_token_secret'];
		if ( empty( $username ) || empty( $consumer_key ) || empty( $consumer_secret )
			|| empty( $access_token ) || empty( $access_token_secret ) ) {
			return false;
		}
		# Create the connection
		$twitter = new TwitterOAuth( $consumer_key, $consumer_secret, $access_token, $access_token_secret );
		# Migrate over to SSL/TLS
		$twitter->ssl_verifypeer = false;
		# Load the Tweets
		try {
			$tweets = $twitter->get( 'statuses/user_timeline', array( 'screen_name' => $username, 'exclude_replies' => 'true', 'include_rts' => 'false', 'count' => $number_tweets ) );
			# Example output
			//echo '<pre>';print_r($tweets);die();
			if ( ! empty( $tweets ) ) {
				echo '<div class="latest-tweets"><ul>';
				foreach ( $tweets as $_tweet ) {
					$user   = $_tweet->user;
					$handle = $user->screen_name;
					$id_str = $_tweet->id_str;
					$link   = esc_html( 'http://twitter.com/' . $handle . '/status/' . $id_str );
					$date   = DateTime::createFromFormat( 'D M d H:i:s O Y', $_tweet->created_at );
					$output = '<li>';
					$output .= '<div class="twitter-tweet"><i class="fa fa-x-twitter"></i><div class ="tweet-text">' . esc_attr( $_tweet->text ) . '<p class="my-date">' . esc_attr( $date->format( 'g:i A - j M Y' ) ) . '</p></div>';
					$output .= '</div></li>';
					echo $output;
				}
				echo '</ul></div>';
			}
		}
		catch ( Exception $exc ) {
			echo esc_html__( 'Something wrong, please check the connection or the api config!', 'arrowpress-core' );
		}

		return null;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {
		$options      = get_option( 'arrowpress_instagram' );
		$access_token = $options['access_token'];
		$user_id      = $options['user_id'];

		extract( $args );
		$tag   = ( ! empty( $instance['tag'] ) ) ? strip_tags( $instance['tag'] ) : '';
		$title = apply_filters( 'widget_title', $instance['title'] );
		$i     = 0;
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>

		<?php if ( $access_token != '' && $user_id != '' ): ?>
			<?php
			$url        = 'https://api.instagram.com/v1/users/' . $user_id . '/media/recent/?access_token=' . $access_token;
			$all_result = $this->process_url( $url );

			$decoded_results = json_decode( $all_result, true );
			?>
			<div class="instagram-container">
				<?php if ( count( $decoded_results ) & isset( $decoded_results['data'] ) ) : ?>
					<?php if ( $instance['number'] <= 9 ): ?>

						<div class="instagram-gallery">
							<?php if ( $tag != "" ): ?>
								<?php foreach ( array_slice( $decoded_results['data'], 0 ) as $value ): ?>
									<?php if ( isset( $value['tags'][0] ) ): ?>
										<?php if ( in_array( $tag, $value['tags'] ) ): ?>
											<?php $i ++; ?>
											<?php if ( $i <= $instance['number'] ): ?>
												<div class="instagram-img"
													 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
													<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
													   href="<?php echo $value['link'] ?>">
														<i class="fa fa-instagram"></i>
													</a>
												</div>
											<?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php else: ?>
								<?php foreach ( array_slice( $decoded_results['data'], 0, $instance['number'] ) as $value ): ?>
									<div class="instagram-img"
										 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
										<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
										   href="<?php echo $value['link'] ?>">
											<i class="fa fa-instagram"></i>
										</a>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					<?php else: ?>
						<div class="instagram-gallery">
							<?php foreach ( array_slice( $decoded_results['data'], 0, 8 ) as $value ): ?>
								<div class="instagram-img"
									 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
									<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
									   href="<?php echo $value['link'] ?>">
										<i class="fa fa-instagram"></i>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				<?php else: ?>
					<p> <?php echo esc_html__( "Access token is not valid.", 'arrowpress-core' ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$defaults = array(
			'title'  => 'Instagram',
			'number' => 9,
			'tag'    => "",
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text"
				   name="<?php echo $this->get_field_name( 'title' ); ?>'" value="<?php echo $instance['title']; ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of photos to display (Less than or equal to 9):' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" type="text"
				   name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tag' ); ?>">Hashtag:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tag' ); ?>" type="text"
				   name="<?php echo $this->get_field_name( 'tag' ); ?>'" value="<?php echo $instance['tag']; ?>"/>
		</p>


		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 * @see WP_Widget::update()
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance           = array();
		$instance['title']  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['tag']    = ( ! empty( $new_instance['tag'] ) ) ? strip_tags( $new_instance['tag'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
	}

	function arrowpress_shortcode_instagram( $atts, $content = null ) {
		$options      = get_option( 'arrowpress_instagram' );
		$access_token = $options['access_token'];
		$user_id      = $options['user_id'];

		$limit    = 50;
		$output   = $el_class = '';
		$per_page = 9;
		extract(
			shortcode_atts( array(
				'layout'               => 'layout1',
				'per_page'             => 11,
				'link_home'            => '',
				'show_spacer'          => 'yes',
				'items_desktop_large1' => 4,
				'items_desktop_large'  => 4,
				'items_desktop'        => 3,
				'items_tablets'        => 2,
				'items_mobile'         => 1,
				'el_class'             => ''
			), $atts )
		);
		$content      = wpb_js_remove_wpautop( $content, true );
		$layout_class = '';
		if ( $layout == 'layout1' ) {
			$layout_class = ' instagram-type1';
		} else if ( $layout == 'layout3' ) {
			$layout_class = ' instagram-type3';
		} else if ( $layout == 'layout4' ) {
			$layout_class = ' instagram-type4';
		} else {
			$layout_class = ' instagram-type2';
		}
		$space_class = '';
		if ( $show_spacer == 'yes' ) {
			$space_class = 'show_space';
		} else {
			$space_class = ' no_space';
		}
		$el_class = arrowpress_shortcode_extract_class( $el_class );
		$output   = '<div class="arrowpress-animation clearfix' . $el_class . '"';
		$output   .= '>';
		ob_start();
		?>
		<?php echo $output; ?>
		<?php if ( $access_token != '' && $user_id != '' ): ?>
			<?php
			$url        = 'https://api.instagram.com/v1/users/' . $user_id . '/media/recent/?access_token=' . $access_token;
			$link_url   = 'https://instagram.com/' . $user_id;
			$all_result = $this->process_url( $url );

			$decoded_results = json_decode( $all_result, true );
			?>
			<div class="instagram-container <?php echo $layout_class; ?> <?php echo $space_class; ?>">
				<?php if ( $layout == "layout2" ): ?>
					<div class="instagram-grid">
						<?php if ( count( $decoded_results ) && $decoded_results['data'] ) : ?>
							<?php foreach ( array_slice( $decoded_results['data'], 0, $per_page ) as $value ): ?>
								<div class="instagram-img"
									 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
									<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
									   href="<?php echo $value['link'] ?>">
										<i class="fa fa-instagram"></i>
									</a>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function ($) {
							jQuery('.instagram-grid').slick({
								centerMode: false,
								dots      : false,
								<?php if(is_rtl()): ?>
								rtl: true,
								<?php endif; ?>
								arrows        : false,
								slidesToShow  : <?php echo $items_desktop_large; ?>,
								slidesToScroll: 1,
								infinite      : true,
								responsive    : [
									{
										breakpoint: 1367,
										settings  : {
											slidesToShow: <?php echo $items_desktop_large1; ?>
										}
									},
									{
										breakpoint: 1200,
										settings  : {
											slidesToShow: <?php echo $items_desktop; ?>
										}
									},
									{
										breakpoint: 1025,
										settings  : {
											slidesToShow: <?php echo $items_tablets; ?>
										}
									},
									{
										breakpoint: 768,
										settings  : {
											slidesToShow: <?php echo $items_tablets; ?>
										}
									},
									{
										breakpoint: 481,
										settings  : {
											slidesToShow: <?php echo $items_mobile; ?>
										}
									}
								]
							});
						});
					</script>
				<?php elseif ( $layout == "layout3" ): ?>
					<div class="instagram-image">
						<div class="instagram_parkery">
							<?php
							$i            = 1;
							$pakery_class = '';
							?>
							<?php if ( count( $decoded_results ) && $decoded_results['data'] ) : ?>
								<?php foreach ( array_slice( $decoded_results['data'], 0, $per_page ) as $value ): ?>
									<?php
									$index_size  = array( '1', '4' );
									$index_size2 = array( '2' );
									$index_size3 = array( '3', '10', '14', '18', '22', '26', '30', '34', '38', '42', '46', '50' );
									$index_size4 = array( '5', '7', '8', '11', '12', '15', '16', '19', '20', '23', '24', '27', '28', '31', '32', '35', '36', '39', '40', '43', '44', '47', '48' );
									$index_size5 = array( '6', '9', '13', '17', '21', '25', '29', '33', '37', '41', '45', '49' );
									if ( in_array( $i, $index_size2 ) ) {
										$pakery_class = 'image_size2';
									} elseif ( in_array( $i, $index_size3 ) ) {
										$pakery_class = 'image_size3';
									} elseif ( in_array( $i, $index_size4 ) ) {
										$pakery_class = 'image_size4';
									} elseif ( in_array( $i, $index_size5 ) ) {
										$pakery_class = 'image_size5';
									} else {
										$pakery_class = 'image_size';
									}
									?>
									<div class="instagram-content <?php echo esc_attr( $pakery_class ); ?>">
										<div class="instagram-img"
											 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
											<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
											   href="<?php echo $value['link'] ?>">
												<i class="fa fa-instagram"></i>
											</a>
										</div>
									</div>
									<?php $i ++; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php elseif ( $layout == "layout4" ): ?>
					<div class="instagram-image">
						<div class="instagram_parkery">
							<?php
							$i            = 1;
							$pakery_class = '';
							?>
							<?php if ( count( $decoded_results ) && $decoded_results['data'] ) : ?>
								<?php foreach ( array_slice( $decoded_results['data'], 0, $per_page ) as $value ): ?>
									<?php
									$index_size  = array( '1', '7', '13', '19', '25', '31', '37', '43', '49' );
									$index_size1 = array( '2', '8', '14', '20', '26', '32', '38', '44', '50' );
									$index_size2 = array( '3', '4', '9', '10', '15', '16', '21', '22', '27', '28', '33', '34', '39', '40', '45', '46' );
									$index_size3 = array( '5', '6', '11', '12', '17', '18', '23', '24', '29', '30', '35', '36', '41', '42', '47', '48' );
									if ( in_array( $i, $index_size1 ) ) {
										$pakery_class = 'image_size1';
									} elseif ( in_array( $i, $index_size2 ) ) {
										$pakery_class = 'image_size2';
									} elseif ( in_array( $i, $index_size3 ) ) {
										$pakery_class = 'image_size3';
									} else {
										$pakery_class = 'image_size';
									}
									?>
									<div class="instagram-content <?php echo esc_attr( $pakery_class ); ?>">
										<div class="instagram-img"
											 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
											<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
											   href="<?php echo $value['link'] ?>">
												<i class="fa fa-instagram"></i>
											</a>
										</div>
									</div>
									<?php $i ++; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php else: ?>
					<div class="instagram-image">
						<div class="instagram_parkery">
							<?php
							$i            = 1;
							$pakery_class = '';
							?>
							<?php if ( count( $decoded_results ) && $decoded_results['data'] ) : ?>
								<?php foreach ( array_slice( $decoded_results['data'], 0, $per_page ) as $value ): ?>
									<?php
									$index_size  = array( '1', '5', '6', '8', '10', '14', '15', '17', '19', '23', '24', '26', '30', '32', '36', '37', '39', '41', '45', '46', '48', '50' );
									$index_size1 = array( '2', '11', '20', '28', '33', '42', '51' );
									$index_size2 = array( '3', '4', '7', '9', '12', '13', '16', '18', '21', '22', '25', '27', '29', '31', '34', '35', '38', '40', '43', '44', '47', '49', '52', '53' );
									if ( in_array( $i, $index_size1 ) ) {
										$pakery_class = 'image_size1';
									} elseif ( in_array( $i, $index_size2 ) ) {
										$pakery_class = 'image_size2';
									} else {
										$pakery_class = 'image_size';
									}
									?>
									<div class="instagram-content <?php echo esc_attr( $pakery_class ); ?>">
										<div class="instagram-img"
											 style="background-image: url(<?php echo $value['images']['standard_resolution']['url'] ?>)">
											<a title="<?php echo $value['caption']['text'] ?>" target="_blank"
											   href="<?php echo $value['link'] ?>">
												<i class="fa fa-instagram"></i>
											</a>
										</div>
									</div>
									<?php $i ++; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<?php if ( $link_home != '' ): ?>
					<div class="view-instar text-center">
						<a target="_blank" class="btn btn-primary"
						   href="<?php echo esc_url( $link_home ); ?>"><?php echo esc_html( 'View more', 'arrowpress-core' ) ?></a>
					</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="row">
				<?php echo __( 'Instagram Plugin error: Plugin not fully configured', 'arrowpress-core' ) ?>
			</div>
		<?php endif; ?>

		</div>
		<?php
		return ob_get_clean();
	}

	function process_url( $url ) {
		$ch = curl_init();
		curl_setopt_array( $ch, array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2
		) );

		$result = curl_exec( $ch );
		curl_close( $ch );

		return $result;
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'arrowpress_social' );
} );
