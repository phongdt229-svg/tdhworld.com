<?php
add_action( 'widgets_init', 'apr_latesttweet_init_widget' );

function apr_latesttweet_init_widget() {
	register_widget( 'ArrowpressLatestTweetWidget' );
}

class ArrowpressLatestTweetWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'arrowpress_latest_tweet', // Base ID
			__( 'Arrowpress Latest Tweet', 'arrowpress-core' ), // Name
			array( 'description' => __( 'This Widget show the Latest Tweets', 'arrowpress-core' ), ) // Args
		);
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
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$number_tweets = 5;
		if ( ! empty( $instance['tweet_limit'] ) && $instance['tweet_limit'] >= 0 ) {
			$number_tweets = $instance['tweet_limit'];
		}
		$tweets = new arrowpress_social();
		$tweets->get_tweets( $number_tweets );
		//content here
		echo $args['after_widget'];
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Latest Twitter', 'arrowpress-core' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$tweet_limit = ! empty( $instance['tweet_limit'] ) ? $instance['tweet_limit'] : 5;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'tweet_limit' ); ?>"><?php _e( 'Number of tweets:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tweet_limit' ); ?>"
				   name="<?php echo $this->get_field_name( 'tweet_limit' ); ?>" type="text"
				   value="<?php echo esc_attr( $tweet_limit ); ?>">
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
		$instance                = array();
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['tweet_limit'] = ( ! empty( $new_instance['tweet_limit'] ) ) ? strip_tags( $new_instance['tweet_limit'] ) : '';

		return $instance;
	}

}
