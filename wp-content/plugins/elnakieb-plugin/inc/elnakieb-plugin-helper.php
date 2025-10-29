<?php
/**
 * elnakieb Theme Helper Class
 *
 *
 * @class        Elnakieb_Plugin_Helper
 * @version      1.0
 * @category 	 Class
 * @author       Elnakieb
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elnakieb_Plugin_Helper' ) ) {
	class Elnakieb_Plugin_Helper {

		/**
		 * Get Header Template Type
		 *
		 * @return  [type]  [return description]
		 */
		public static function get_header_types() {
			$header = ['' => 'Default'];
			$headers = get_posts(
				[
					'posts_per_page' => - 1,
					'post_type'      => 'elnakieb_template',
					'orderby'        => 'name',
					'order'          => 'ASC',
					'meta_query' => array(
						array(
							'key'       => 'elnakieb_template_type',
							'value'     => 'tf_header_key',
							'compare'   => '='
						)
					)
				]
			);
			foreach ($headers as  $value) {
				$header[$value->ID] = $value->post_title;
			}
			return $header;
		}

		/**
		 * Get Footer Template Type
		 *
		 * @return  [type]  [return description]
		 */
		public static function get_footer_types() {
			$footer = ['' => 'Default'];
			$footers = get_posts(
				[
					'posts_per_page' => - 1,
					'post_type'      => 'elnakieb_template',
					'orderby'        => 'name',
					'order'          => 'ASC',
					'meta_query' => array(
						array(
							'key'       => 'elnakieb_template_type',
							'value'     => 'tf_footer_key',
							'compare'   => '='
						)
					)
				]
			);
			foreach ($footers as  $value) {
				$footer[$value->ID] = $value->post_title;
			}
			return $footer;
		}

		/**
		 * Render Header
		 *
		 * @param   [type]  $header_style  [$header_style description]
		 *
		 * @return  [type]                 [return description]
		 */
		public static function elnakieb_render_header($header_style){
			$elementor_instance = Elementor\Plugin::instance();
			return $elementor_instance->frontend->get_builder_content_for_display( $header_style );
		}


		/**
		 * Render Footer
		 *
		 * @param   [type]  $footer_style  [$footer_style description]
		 *
		 * @return  [type]                 [return description]
		 */
		public static function elnakieb_render_footer($footer_style){
			$elementor_instance = Elementor\Plugin::instance();
			return $elementor_instance->frontend->get_builder_content_for_display( $footer_style );
		}

		/**
		 * Category Proce
		 *
		 * @return  [type]  [return description]
		 */
		public static function elnakieb_blog_category(){
			$terms = get_terms( array(
				'taxonomy'    => 'category',
				'hide_empty'  => true
			) );
		  
			$cat_list = [];
			foreach($terms as $post) {
			$cat_list[$post->slug]  = [$post->name];
			}
			return $cat_list;
		}

		
		public static function elnakieb_portfolio_category(){
			$terms = get_terms( array(
				'taxonomy'    => 'portfolio_cat',
				'hide_empty'  => true,
			) );
		
			$cat_list = [];
			foreach($terms as $post) {
			$cat_list[$post->slug]  = [$post->name];
			}
			return $cat_list;
		}
  

	}
	// Instantiate theme
	new Elnakieb_Plugin_Helper();
}