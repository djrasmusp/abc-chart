<?php


namespace ACP\Base;

use ACP\Base\BaseController;

if ( ! class_exists( 'CustomPostTypes' ) ) {
	class CustomPostTypes extends BaseController {
		public function register() {
			add_action( 'init', array( $this, 'setCustomPostType' ) );
			add_action( 'init', array( $this, 'setCustomPostTypeTax' ) );
			add_action( 'init', array( $this, 'setTerms' ) );
			flush_rewrite_rules();
		}

		function setCustomPostType() {
			$labels = array(
				'name'               => _x( 'ABC Charts',
				                            'post type general name' ),
				'singular_name'      => _x( 'Chart',
				                            'post type singular name' ),
				'add_new'            => _x( 'Add New Chart', 'chart' ),
				'add_new_item'       => __( 'Add New Chart' ),
				'edit_item'          => __( 'Edit Chart' ),
				'new_item'           => __( 'New Chart' ),
				'all_items'          => __( 'All Charts' ),
				'view_item'          => __( 'View Charts' ),
				'search_items'       => __( 'Search Charts' ),
				'not_found'          => __( 'No charts found' ),
				'not_found_in_trash' => __( 'No charts found in the Trash' ),
				'parent_item_colon'  => null,
				'menu_name'          => 'ABC Charts'
			);
			$args   = array(
				'labels'        => $labels,
				'public'        => true,
				'rewrite'       => array( 'slug' => 'hitlister' ),
				'menu_position' => 20,
				'menu_icon'     => 'data:image/svg+xml;base64,'
				                   . base64_encode( '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <path fill="black" d="M61.77 401l17.5-20.15a19.92 19.92 0 005.07-14.19v-3.31C84.34 356 80.5 352 73 352H16a8 8 0 00-8 8v16a8 8 0 008 8h22.83a157.41 157.41 0 00-11 12.31l-5.61 7c-4 5.07-5.25 10.13-2.8 14.88l1.05 1.93c3 5.76 6.29 7.88 12.25 7.88h4.73c10.33 0 15.94 2.44 15.94 9.09 0 4.72-4.2 8.22-14.36 8.22a41.54 41.54 0 01-15.47-3.12c-6.49-3.88-11.74-3.5-15.6 3.12l-5.59 9.31c-3.72 6.13-3.19 11.72 2.63 15.94 7.71 4.69 20.38 9.44 37 9.44 34.16 0 48.5-22.75 48.5-44.12-.03-14.38-9.12-29.76-28.73-34.88zM496 224H176a16 16 0 00-16 16v32a16 16 0 0016 16h320a16 16 0 0016-16v-32a16 16 0 00-16-16zm0-160H176a16 16 0 00-16 16v32a16 16 0 0016 16h320a16 16 0 0016-16V80a16 16 0 00-16-16zm0 320H176a16 16 0 00-16 16v32a16 16 0 0016 16h320a16 16 0 0016-16v-32a16 16 0 00-16-16zM16 160h64a8 8 0 008-8v-16a8 8 0 00-8-8H64V40a8 8 0 00-8-8H32a8 8 0 00-7.14 4.42l-8 16A8 8 0 0024 64h8v64H16a8 8 0 00-8 8v16a8 8 0 008 8zm-3.91 160H80a8 8 0 008-8v-16a8 8 0 00-8-8H41.32c3.29-10.29 48.34-18.68 48.34-56.44 0-29.06-25-39.56-44.47-39.56-21.36 0-33.8 10-40.46 18.75-4.37 5.59-3 10.84 2.8 15.37l8.58 6.88c5.61 4.56 11 2.47 16.12-2.44a13.44 13.44 0 019.46-3.84c3.33 0 9.28 1.56 9.28 8.75C51 248.19 0 257.31 0 304.59v4C0 316 5.08 320 12.09 320z"/>
</svg>' ),
				'supports'      => array( 'title', 'thumbnail' ),
				'has_archive'   => false
			);

			register_post_type( 'chart', $args );
		}

		function setCustomPostTypeTax() {
			$labels = array(
				'name'          => _x( 'Chart Types',
				                       'taxonomy general name' ),
				'singular_name' => _x( 'Chart Type',
				                       'taxonomy singular name' )
			);
			$args   = array(
				'labels'       => $labels,
				'hierarchical' => true,
				'public'       => false,
			);
			register_taxonomy( 'chart_type', 'chart', $args );
		}

		function setTerms() {
			foreach ( $this->plugin_terms as $term ) {
				wp_insert_term( $term['term'],
				                'chart_type',
				                array( 'slug' => $term['slug'] ) );
			}
		}
	}
}
