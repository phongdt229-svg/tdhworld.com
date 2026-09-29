<?php

class Apr_Core_Recipe_Metabox extends Apr_Metabox {

	function register_page_metabox( $meta_boxes ) {
 		$meta_boxes[] = $this->apr_recipe_meta_data();
		return $meta_boxes;
	}

	public function apr_recipe_meta_data() {
		return array(
			'id'         => 'metabox_recipe',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Recipe Options', 'efarm' ),
			'post_types' => array( 'recipe' ),
			'fields'     => array(
                array(
                    "id" => "desc",
                    'label' => esc_html__("Description", 'efarm'),
                    "type" => "wysiwyg"
                ),
                array(
                    "id" => "ingre",
                    'label' => esc_html__("Ingredient", 'efarm'),
                    "type" => "wysiwyg"
                ),
                array(
                    "id" => "time",
                    'label' => esc_html__("Time", 'efarm'),
                    "type" => "text"
                ),
                array(
                    "id" => "serving",
                    'label' => esc_html__("Servings", 'efarm'),
                    "type" => "text"
                ),

                array(
                    "id" => "cals",
                    'label' => esc_html__("Cals", 'efarm'),
                    "type" => "text"
                ),
                array(
                    "id" => "recipe_video",
                    'label' => esc_html__("Video link", 'efarm'),
                    "type" => "text",
                ),
			),
		);
	}

}

if ( class_exists( 'Apr_Core_Recipe_Metabox' ) ) {
	new Apr_Core_Recipe_Metabox;
};
