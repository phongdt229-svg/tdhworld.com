<?php

class Apr_Core_Post_Metabox extends Apr_Metabox {

	function register_page_metabox( $meta_boxes ) {
		$meta_boxes[] = $this->arrowpress_metabox_video();
		$meta_boxes[] = $this->arrowpress_metabox_link();
		$meta_boxes[] = $this->arrowpress_metabox_quote();
		$meta_boxes[] = $this->arrowpress_metabox_gallery();

		return $meta_boxes;
	}

	public function arrowpress_metabox_video() {
		return array(
			'id'         => 'metabox_video',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Video', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'video' ),
			),
			'fields'     => array(
				array(
					'id'   => 'video_code',
					'name' => __( 'Video & Audio Embed Code', 'arrowpress-core' ),
					'desc' => esc_html__( 'Enter the embed link (Youtube or Vimeo). ', 'efarm' ),
					'type' => 'textarea',
				),
			),
		);
	}

	public function arrowpress_metabox_link() {

		$metabox_link = array(
			'id'         => 'metabox_link',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Link', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'link' ),
			),
			'fields'     => array(
				array(
					'id'   => 'link_code',
					'name' => __( 'Link', 'arrowpress-core' ),
					"desc" => esc_html__( 'Enter link. ', 'efarm' ),
					'type' => 'text',
				),
				array(
					'id'   => 'link_title',
					'name' => __( 'Link title', 'arrowpress-core' ),
					'type' => 'text',
				),
			),
		);

		return $metabox_link;
	}

	public function arrowpress_metabox_quote() {
		$metabox_quote = array(
			'id'         => 'metabox_quote',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Quote', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'quote' ),
			),
			'fields'     => array(
				array(
					'id'   => 'quote_code',
					'name' => __( 'Quote', 'arrowpress-core' ),
					'type' => 'textarea',
				),
				array(
					'id'   => 'quote_author',
					'name' => __( 'Quote author', 'arrowpress-core' ),
					'type' => 'text',
				),
			),
		);

		return $metabox_quote;
	}

	public function arrowpress_metabox_gallery() {

		$metabox_gallery = array(
			'id'         => 'metabox_gallery',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Gallery', 'efarm' ),
			'post_types' => array( 'post' ),
			'show'       => array( 'post_format' => array( 'gallery' ) ),
			'fields'     => array(
				array(
					'id'               => 'images_gallery',
					'desc'             => esc_html__( ' Select or Upload Image ', 'efarm' ),
					'default'          => '',
					'type'             => 'image_advanced',
					'max_file_uploads' => 999,
				),

			),
		);

		return $metabox_gallery;
	}
}

if ( class_exists( 'Apr_Core_Post_Metabox' ) ) {
	new Apr_Core_Post_Metabox;
};

