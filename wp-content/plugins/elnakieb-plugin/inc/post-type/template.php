<?php
if(!function_exists('elnakieb_page_template_type')  ){
    function elnakieb_page_template_type(){
		register_post_type( 'elnakieb_template',
		array(
			  'labels' => array(
				'name' => __( 'Template','elnakieb-plugin' ),
				'singular_name' => __( 'Template','elnakieb-plugin' )
			  ),
			'public' => true,
			'publicly_queryable' => true,
			'show_in_menu'      => false,
			'show_in_nav_menus'   => false,
			'supports' => ['title', 'elementor']
		)
		);
	}
	add_action( 'init','elnakieb_page_template_type',2 );
}
