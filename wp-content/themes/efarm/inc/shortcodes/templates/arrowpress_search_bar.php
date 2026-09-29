<?php
$output = $title = '';
extract(
	shortcode_atts( array(
		'title'    => '',
		'el_class' => ''
	), $atts )
);
$el_class = arrowpress_shortcode_extract_class( $el_class );
$output   = '<div class="search-content' . $el_class . '"';
$output   .= '>';
ob_start();
?>
	<div class="search-bar">
		<?php
		$apr_search_template = apr_get_search_form();
		echo '<div class="search-block-top">' . wp_kses( $apr_search_template, apr_allow_html() ) . '</div>';
		?>
	</div>
<?php
$output .= ob_get_clean();
$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_search_bar' ) . "\n";

echo $output;


wp_reset_postdata();
