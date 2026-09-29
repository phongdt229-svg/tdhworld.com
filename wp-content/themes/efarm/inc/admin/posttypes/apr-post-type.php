<?php

class ArrowPressPostTypes {

	function __construct() {
		// Register post types
		add_action( 'init', array( $this, 'addBlockPostType' ) );
		add_action( 'init', array( $this, 'addGalleryPostType' ) );
		add_action( 'init', array( $this, 'addRecipePostType' ) );
		add_action( 'init', array( $this, 'addKnowledgePostType' ) );
		add_action( 'init', array( $this, 'addPressPostType' ) );
		add_filter( 'manage_gallery_posts_columns', array( $this, 'addGallery_columns' ) );
		add_action( 'manage_gallery_posts_custom_column', array( $this, 'addGallery_columns_content' ), 10, 2 );
		add_filter( 'manage_recipe_posts_columns', array( $this, 'addGallery_columns' ) );
		add_action( 'manage_recipe_posts_custom_column', array( $this, 'addGallery_columns_content' ), 10, 2 );
		add_filter( 'manage_knowledge_posts_columns', array( $this, 'addGallery_columns' ) );
		add_action( 'manage_knowledge_posts_custom_column', array( $this, 'addGallery_columns_content' ), 10, 2 );
		add_filter( 'manage_press_posts_columns', array( $this, 'addGallery_columns' ) );
		add_action( 'manage_press_posts_custom_column', array( $this, 'addGallery_columns_content' ), 10, 2 );
		add_action( 'cmb2_admin_init', array( $this, 'arrowpress_core_add_recipe_field_metabox' ) );
		add_action( 'cmb2_admin_init', array( $this, 'arrowpress_core_add_checkbox_field_metabox' ) );
	}

	// Register static block post type
	function addBlockPostType() {
		register_post_type(
			'block', array(
				'labels'              => $this->getLabels( esc_html__( 'Static Block', 'arrowpress-core' ), esc_html__( 'Static Block', 'arrowpress-core' ) ),
				'exclude_from_search' => true,
				'has_archive'         => false,
				'publicly_queryable'  => false,
				'public'              => true,
				'rewrite'             => array( 'slug' => 'block' ),
				'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
				'can_export'          => true
			)
		);
	}

	// Register Gallery post type
	function addGalleryPostType() {
		global $apr_settings;
		if ( isset( $apr_settings['gallery_slug'] ) ) {
			$gallery_slug = $apr_settings['gallery_slug'];
		} else {
			$gallery_slug = "gallery";
		}
		if ( isset( $apr_settings['gallery_cat_slug'] ) ) {
			$gallery_cat_slug = $apr_settings['gallery_cat_slug'];
		} else {
			$gallery_cat_slug = "gallery_cat";
		}
		if ( isset( $apr_settings['gallery_tag_slug'] ) ) {
			$gallery_tag_slug = $apr_settings['gallery_tag_slug'];
		} else {
			$gallery_tag_slug = "gallery_tag";
		}
		register_post_type(
			'gallery', array(
				'labels'              => $this->getLabels( esc_html__( 'Gallery', 'arrowpress-core' ), esc_html__( 'Galleries', 'arrowpress-core' ) ),
				'exclude_from_search' => false,
				'has_archive'         => true,
				// 'publicly_queryable'  => false,
				'public'              => true,
				'rewrite'             => array( 'slug' => $gallery_slug ),
				'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
				'can_export'          => true
			)
		);
		register_taxonomy(
			'gallery_cat', 'gallery', array(
				'hierarchical'      => true,
				'show_in_nav_menus' => true,
				'labels'            => $this->getTaxonomyLabels( esc_html__( 'Gallery Category', 'arrowpress-core' ), esc_html__( 'Gallery Categories', 'arrowpress-core' ) ),
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $gallery_cat_slug ),
				'show_admin_column' => true,
			)
		);
		register_taxonomy( 'gallery_tag', 'gallery', array(
			'hierarchical'          => false,
			'labels'                => $this->getTaxonomyLabels( esc_html__( 'Gallery Tags', 'efarm' ), esc_html__( 'Gallery Tags', 'efarm' ) ),
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => $gallery_tag_slug ),
		) );
	}

	// Register Recipe post type
	function addRecipePostType() {
		global $apr_settings;
		if ( isset( $apr_settings['recipe_slug'] ) ) {
			$recipe_slug = $apr_settings['recipe_slug'];
		} else {
			$recipe_slug = "recipe";
		}
		if ( isset( $apr_settings['recipe_cat_slug'] ) ) {
			$recipe_cat_slug = $apr_settings['recipe_cat_slug'];
		} else {
			$recipe_cat_slug = "recipe_cat";
		}
		register_post_type(
			'recipe', array(
				'labels'              => $this->getLabels( esc_html__( 'Recipe', 'arrowpress-core' ), esc_html__( 'Recipes', 'arrowpress-core' ) ),
				'exclude_from_search' => false,
				'has_archive'         => true,
				// 'publicly_queryable'  => false,
				'public'              => true,
				'rewrite'             => array( 'slug' => $recipe_slug ),
				'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
				'can_export'          => true
			)
		);
		register_taxonomy(
			'recipe_cat', 'recipe', array(
				'hierarchical'      => true,
				'show_in_nav_menus' => true,
				'labels'            => $this->getTaxonomyLabels( esc_html__( 'Recipe Category', 'arrowpress-core' ), esc_html__( 'Recipe Categories', 'arrowpress-core' ) ),
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $recipe_cat_slug ),
				'show_admin_column' => true,
			)
		);
	}

	// Register Knowledge post type
	function addKnowledgePostType() {
		global $apr_settings;
		if ( isset( $apr_settings['knowledge_slug'] ) ) {
			$knowledge_slug = $apr_settings['knowledge_slug'];
		} else {
			$knowledge_slug = "knowledge";
		}
		if ( isset( $apr_settings['knowledge_cat_slug'] ) ) {
			$knowledge_cat_slug = $apr_settings['knowledge_cat_slug'];
		} else {
			$knowledge_cat_slug = "knowledge_cat";
		}
		register_post_type(
			'knowledge', array(
				'labels'              => $this->getLabels( esc_html__( 'Knowledge', 'arrowpress-core' ), esc_html__( 'Knowledge', 'arrowpress-core' ) ),
				'exclude_from_search' => false,
				'has_archive'         => true,
				// 'publicly_queryable'  => false,
				'public'              => true,
				'rewrite'             => array( 'slug' => $knowledge_slug ),
				'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
				'can_export'          => true
			)
		);
		register_taxonomy(
			'knowledge_cat', 'knowledge', array(
				'hierarchical'      => true,
				'show_in_nav_menus' => true,
				'labels'            => $this->getTaxonomyLabels( esc_html__( 'Knowledge Category', 'arrowpress-core' ), esc_html__( 'Knowledge Categories', 'arrowpress-core' ) ),
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $knowledge_cat_slug ),
				'show_admin_column' => true,
			)
		);
	}

	// Register Press post type
	function addPressPostType() {
		global $apr_settings;
		if ( isset( $apr_settings['press_slug'] ) ) {
			$press_slug = $apr_settings['press_slug'];
		} else {
			$press_slug = "press";
		}
		if ( isset( $apr_settings['press_cat_slug'] ) ) {
			$press_cat_slug = $apr_settings['press_cat_slug'];
		} else {
			$press_cat_slug = "press_cat";
		}
		register_post_type(
			'press', array(
				'labels'              => $this->getLabels( esc_html__( 'Press Media', 'arrowpress-core' ), esc_html__( 'Press Media', 'arrowpress-core' ) ),
				'exclude_from_search' => false,
				'has_archive'         => true,
				// 'publicly_queryable'  => false,
				'public'              => true,
				'rewrite'             => array( 'slug' => $press_slug ),
				'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
				'can_export'          => true
			)
		);
		register_taxonomy(
			'press_cat', 'press', array(
				'hierarchical'      => true,
				'show_in_nav_menus' => true,
				'labels'            => $this->getTaxonomyLabels( esc_html__( 'Press Media Category', 'arrowpress-core' ), esc_html__( 'Press Media Categories', 'arrowpress-core' ) ),
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $press_cat_slug ),
				'show_admin_column' => true,
			)
		);
	}

	/**
	 * Hook in and add a metabox to demonstrate repeatable grouped fields
	 */
	function arrowpress_core_add_recipe_field_metabox() {
		$prefix = 'arrowpress_core_';

		/**
		 * Repeatable Field Groups
		 */
		$cmb_group = new_cmb2_box( array(
			'id'           => $prefix . 'direction',
			'title'        => esc_html__( 'Direction', 'arrowpress-core' ),
			'object_types' => array( 'recipe'  ),
			'classes'      => array( 'arrowpress_recipe_directions_group' ),
		) );

		// $group_field_id is the field id string, so in this case: $prefix . 'demo'
		$group_field_id = $cmb_group->add_field( array(
			'id'          => $prefix . 'direction_group',
			'type'        => 'group',
			'description' => esc_html__( 'Enter directions for recipe', 'arrowpress-core' ),
			'options'     => array(
				'group_title'   => esc_html__( 'Step {#}', 'arrowpress-core' ), // {#} gets replaced by row number
				'add_button'    => esc_html__( 'Add a Direction', 'arrowpress-core' ),
				'remove_button' => esc_html__( 'Remove direction', 'arrowpress-core' ),
				'sortable'      => true, // beta
				// 'closed'     => true, // true to have the groups closed by default
			),
		) );

		$cmb_group->add_group_field( $group_field_id, array(
			'name' => esc_html__( 'Title', 'arrowpress-core' ),
			'id'   => 're_title',
			'type' => 'text',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name' => esc_html__( 'Image', 'arrowpress-core' ),
			'id'   => 're_image',
			'type' => 'file',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'        => esc_html__( 'Description', 'arrowpress-core' ),
			'description' => esc_html__( 'Write a short description for this', 'arrowpress-core' ),
			'id'          => 're_description',
			'type'        => 'textarea_small',
		) );
	}

	/**
	 * Hook in and add a metabox to demonstrate repeatable checkbox fields
	 */
	function arrowpress_core_add_checkbox_field_metabox() {
		$prefix = 'arrowpress_core_';
		/**
		 * Repeatable Field Groups
		 */
		$cmb_term = new_cmb2_box( array(
			'id'               => $prefix . 'edit',
			'title'            => __( 'Settings', 'arrowpress-core' ),
			'object_types'     => array( 'term' ),
			'taxonomies'       => array( 'press_cat', 'knowledge_cat', 'recipe_cat', 'gallery_cat', 'product_cat' ), // CHANGE THIS TO YOUR CUSTOM TAXONOMY
			'new_term_section' => true, // This is important as well
			'classes'          => array( 'arrowpress_checkbox' )
		) );

		$cmb_term->add_field( array(
			'name' => esc_html__( 'Active Category Filter', 'arrowpress-core' ),
			'desc' => esc_html__( 'Active category filter', 'arrowpress-core' ),
			'id'   => 'arrowpress_core_checkbox',
			'type' => 'checkbox',
		) );
	}

	function get_the_image( $post_id = false ) {

		$post_id   = (int) $post_id;
		$cache_key = "featured_image_post_id-{$post_id}-_thumbnail";
		$cache     = wp_cache_get( $cache_key, null );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! array_key_exists( $cache_key, $cache ) ) {
			if ( empty( $cache ) || ! is_string( $cache ) ) {
				$output = '';

				if ( has_post_thumbnail( $post_id ) ) {
					$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), array( 36, 32 ) );

					if ( is_array( $image_array ) && is_string( $image_array[0] ) ) {
						$output = $image_array[0];
					}
				}

				if ( empty( $output ) ) {
					// $output = plugins_url( 'images/default.png', __FILE__ );
					// $output = apply_filters( 'featured_image_column_default_image', $output );
				}

				$output            = esc_url( $output );
				$cache[$cache_key] = $output;

				wp_cache_set( $cache_key, $cache, null, 60 * 60 * 24 /* 24 hours */ );
			}
		}

		return isset( $cache[$cache_key] ) ? $cache[$cache_key] : $output;
	}

	function addGallery_columns( $defaults ) {

		if ( ! is_array( $defaults ) ) {
			$defaults = array();
		}
		$new = array();
		foreach ( $defaults as $key => $title ) {
			if ( $key == 'title' ) {
				$new['featured_image'] = 'Image';
			}

			$new[$key] = $title;
		}

		return $new;
	}

	// SHOW THE FEATURED IMAGE
	function addGallery_columns_content( $column_name, $post_id ) {
		if ( 'featured_image' != $column_name ) {
			return;
		}

		$image_src = self::get_the_image( $post_id );

		if ( empty( $image_src ) ) {
			echo "&nbsp;"; // This helps prevent issues with empty cells

			return;
		}

		echo '<img alt="' . esc_attr( get_the_title() ) . '" src="' . esc_url( $image_src ) . '" />';
	}

	// Get content type labels
	function getLabels( $singular_name, $name, $title = false ) {
		if ( ! $title ) {
			$title = $name;
		}

		return array(
			"name"               => $title,
			"singular_name"      => $singular_name,
			"add_new"            => esc_html__( "Add New", 'arrowpress-core' ),
			"add_new_item"       => sprintf( esc_html__( "Add New %s", 'arrowpress-core' ), $singular_name ),
			"edit_item"          => sprintf( esc_html__( "Edit %s", 'arrowpress-core' ), $singular_name ),
			"new_item"           => sprintf( esc_html__( "New %s", 'arrowpress-core' ), $singular_name ),
			"view_item"          => sprintf( esc_html__( "View %s", 'arrowpress-core' ), $singular_name ),
			"search_items"       => sprintf( esc_html__( "Search %s", 'arrowpress-core' ), $name ),
			"not_found"          => sprintf( esc_html__( "No %s found", 'arrowpress-core' ), $name ),
			"not_found_in_trash" => sprintf( esc_html__( "No %s found in Trash", 'arrowpress-core' ), $name ),
			"parent_item_colon"  => ""
		);
	}

	// Get content type taxonomy labels
	function getTaxonomyLabels( $singular_name, $name ) {
		return array(
			"name"              => $name,
			"singular_name"     => $singular_name,
			"search_items"      => sprintf( esc_html__( "Search %s", 'arrowpress-core' ), $name ),
			"all_items"         => sprintf( esc_html__( "All %s", 'arrowpress-core' ), $name ),
			"parent_item"       => sprintf( esc_html__( "Parent %s", 'arrowpress-core' ), $singular_name ),
			"parent_item_colon" => sprintf( esc_html__( "Parent %s:", 'arrowpress-core' ), $singular_name ),
			"edit_item"         => sprintf( esc_html__( "Edit %s", 'arrowpress-core' ), $singular_name ),
			"update_item"       => sprintf( esc_html__( "Update %s", 'arrowpress-core' ), $singular_name ),
			"add_new_item"      => sprintf( esc_html__( "Add New %s", 'arrowpress-core' ), $singular_name ),
			"new_item_name"     => sprintf( esc_html__( "New %s Name", 'arrowpress-core' ), $singular_name ),
			"menu_name"         => $name,
		);
	}

}

new ArrowPressPostTypes();
