<?php

/**
 * ANP Meetings Proposals Post Type
 *
 * @author    Pea, Glocal
 * @license   GPL-2.0+
 * @link      http://glocal.coop
 * @since     1.0.0
 * @package   ANP_Meetings
 */

/**
 * Add Custom Post Type
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'anp_proposals_post_type' ) ) {

    // Register Custom Post Type
    function anp_proposals_post_type() {

        $slug = apply_filters( 'anp_proposal_post_type', 'proposal' );

        $capabilities = array(
            'publish_posts'         => 'publish_meetings',
            'edit_posts'            => 'edit_meetings',
            'edit_others_posts'     => 'edit_others_meetings',
            'delete_posts'          => 'delete_meetings',
            'delete_others_posts'   => 'delete_others_meetings',
            'read_private_posts'    => 'read_private_meetings',
            'edit_post'             => 'edit_meeting',
            'delete_post'           => 'delete_meeting',
            'read_post'             => 'read_meeting',
        );

        $labels = array(
            'name'                => _x( 'Proposals', 'Post Type General Name', 'meetings' ),
            'singular_name'       => _x( 'Proposal', 'Post Type Singular Name', 'meetings' ),
            'menu_name'           => __( 'Proposals', 'meetings' ),
            'name_admin_bar'      => __( 'Proposals', 'meetings' ),
            'parent_item_colon'   => __( 'Parent Proposal:', 'meetings' ),
            'all_items'           => __( 'All Proposals', 'meetings' ),
            'add_new_item'        => __( 'Add New Proposal', 'meetings' ),
            'add_new'             => __( 'Add Proposal', 'meetings' ),
            'new_item'            => __( 'New Proposal', 'meetings' ),
            'edit_item'           => __( 'Edit Proposal', 'meetings' ),
            'update_item'         => __( 'Update Proposal', 'meetings' ),
            'view_item'           => __( 'View Proposal', 'meetings' ),
            'search_items'        => __( 'Search Proposal', 'meetings' ),
            'not_found'           => __( 'Not found', 'meetings' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'meetings' ),
        );
        $rewrite = array(
            'slug'                => $slug,
            'with_front'          => false,
            'pages'               => true,
            'feeds'               => true,
        );
        $default_config = array(
            'label'               => __( 'Proposal', 'meetings' ),
            'description'         => __( '', 'meetings' ),
            'labels'              => $labels,
            'supports'            => array(
                'title',
                'editor',
                'excerpt',
                'author',
                'comments',
                'custom-fields',
                'wpcom-markdown',
                'revisions',
                'attributes'
             ),
            'taxonomies'          => array(
                'organization',
                'event-tag',
                'proposal_status',
            ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'menu_position'       => 30,
            'menu_icon'             => 'dashicons-lightbulb',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => 'proposals',
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'query_var'           => $slug,
            'rewrite'             => $rewrite,
            'show_in_rest'        => true,
	  		'rest_base'           => $slug,
	  		'rest_controller_class' => 'WP_REST_Posts_Controller',
            'capability_type'     => array( 'post' ),
			'map_meta_cap'		  => true,
			'capabilities'        => apply_filters( 'anp_meetings_proposal_capabilities', $capabilities )
        );
        // Allow customization of the default post type configuration via filter.
        $config = apply_filters( 'proposal_post_type_defaults', $default_config, $slug );

        register_post_type( $slug, $config );

    }
    add_action( 'init', 'anp_proposals_post_type', 0 );

}

/**
 * Add Custom Taxonomy
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'anp_proposals_status_taxonomy' ) ) {

    // Register Custom Taxonomy
    function anp_proposals_status_taxonomy() {

        $slug = apply_filters( 'anp_proposal_status_taxonomy', 'proposal_status' );

        $labels = array(
            'name'                       => _x( 'Proposal Statuses', 'Taxonomy General Name', 'meetings' ),
            'singular_name'              => _x( 'Proposal Status', 'Taxonomy Singular Name', 'meetings' ),
            'menu_name'                  => __( 'Statuses', 'meetings' ),
            'all_items'                  => __( 'All Proposal Statuses', 'meetings' ),
            'parent_item'                => __( 'Parent Proposal Status', 'meetings' ),
            'parent_item_colon'          => __( 'Parent Proposal Status:', 'meetings' ),
            'new_item_name'              => __( 'New Proposal Status Name', 'meetings' ),
            'add_new_item'               => __( 'Add New Proposal Status', 'meetings' ),
            'edit_item'                  => __( 'Edit Proposal Status', 'meetings' ),
            'update_item'                => __( 'Update Proposal Status', 'meetings' ),
            'view_item'                  => __( 'View Proposal Status', 'meetings' ),
            'separate_items_with_commas' => __( 'Separate proposal status with commas', 'meetings' ),
            'add_or_remove_items'        => __( 'Add or remove proposal status', 'meetings' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'meetings' ),
            'popular_items'              => __( 'Popular Proposal Statuses', 'meetings' ),
            'search_items'               => __( 'Search Proposal Status', 'meetings' ),
            'not_found'                  => __( 'Not Found', 'meetings' ),
        );
        $rewrite = array(
            'slug'                       => 'proposal-status',
            'with_front'                 => true,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'query_var'                  => $slug,
            'show_in_rest'       		 => true,
            'rest_base'          		 => $slug,
            'rest_controller_class' 	 => 'WP_REST_Terms_Controller',
            'rewrite'                    => $rewrite,
        );
        register_taxonomy( 'proposal_status', array( 'proposal' ), $args );

    }
    add_action( 'init', 'anp_proposals_status_taxonomy', 0 );

}

/**
 * Move Admin Menus
 * Display admin as submenu under Meetings
 *
 * @uses `add_submenu_page` with $cap set to `edit_proposals`
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'anp_proposals_add_to_menu' ) ) {

    function anp_proposals_add_to_menu() {

        add_submenu_page(
            'edit.php?post_type=event',
            __('Proposals', 'meetings'),
            __('Proposals', 'meetings'),
            'edit_events',
            'edit.php?post_type=proposal'
        );

        add_submenu_page(
            'edit.php?post_type=event',
            __('New Proposal', 'meetings'),
            __('Add Proposal', 'meetings'),
            'edit_events',
            'post-new.php?post_type=proposal'
        );

        add_submenu_page(
            'edit.php?post_type=event',
            __('Proposal Statuses', 'meetings'),
            __('Proposal Statuses', 'meetings'),
            'edit_events',
            'edit-tags.php?taxonomy=proposal_status&post_type=proposal'
        );

    }

    add_action('admin_menu', 'anp_proposals_add_to_menu');

}

function anp_remove_status_meta() {
    remove_meta_box( 'proposal_statusdiv' , 'proposal' , 'side' );
}

add_action( 'admin_menu', 'anp_remove_status_meta' );


?>
