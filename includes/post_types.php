<?php
add_action( 'init', 'ippi_register_post_types' );

function ippi_register_post_types (){

    //Post type Report
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Report', 'ippi'),
        'singular_name' => _x('Report', 'ippi'),
        'menu_name' => _x('Report', 'ippi'),
        'name_admin_bar' => _x('Report', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Report', 'ippi'),
        'new_item' => __('New Report', 'ippi'),
        'edit_item' => __('Edit Report', 'ippi'),
        'view_item' => __('View Report', 'ippi'),
        'all_items' => __('All Report', 'ippi'),
        'search_items' => __('Search Report', 'ippi'),
        'not_found' => __('No Report found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-text-page',
    );
    register_post_type('post-report', $args);

    $labels = array(
        'name' => __('Category', 'ippi'),
        'singular_name' => __('Category', 'ippi'),
        'search_items' => __('Search Category', 'ippi'),
        'all_items' => __('All Category', 'ippi'),
        'parent_item' => __('Parent Category', 'ippi'),
        'parent_item_colon' => __('Parent Category:', 'ippi'),
        'edit_item' => __('Edit Category', 'ippi'),
        'update_item' => __('Update Category', 'ippi'),
        'add_new_item' => __('Add New Category', 'ippi'),
        'new_item_name' => __('New Category Name', 'ippi'),
        'menu_name' => __('Category', 'ippi'),
    );
    // Now register the taxonomy
    register_taxonomy('report-category', array('post-report'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'report-category'),
    ));
    //End Post type Report

    //Change Post post type lables
    $get_post_type = get_post_type_object('post');
	$labels = $get_post_type->labels;
	$labels->name = 'Publications';
	$labels->singular_name = 'Publication';
	$labels->add_new = 'Add New';
	$labels->add_new_item = 'Add New Publication';
	$labels->edit_item = 'Edit Publication';
	$labels->new_item = 'New Publication';
	$labels->view_item = 'View Publication';
	$labels->search_items = 'Search Publications';
	$labels->update_item = 'Update Publication';
	$labels->not_found = 'No publications found';
	$labels->not_found_in_trash = 'No publications found in Trash';
	$labels->all_items = 'All Publications';
	$labels->menu_name = 'Publications';
	$labels->name_admin_bar = 'Publications';

	$publication_labels = array(
		'name' => _x('Publications Type', 'ippi'),
		'singular_name' => _x('Publications', 'ippi'),
		'search_items' => __('Search Publications', 'ippi'),
		'all_items' => __('All Publications Type', 'ippi'),
		'parent_item' => __('Parent Publications Type', 'ippi'),
		'parent_item_colon' => __('Parent Publications Type:', 'ippi'),
		'edit_item' => __('Edit Publications', 'ippi'),
		'update_item' => __('Update Publications Type', 'ippi'),
		'add_new_item' => __('Add New Publications Type', 'ippi'),
		'new_item_name' => __('New Publications Name', 'ippi'),
		'menu_name' => __('Publications Type', 'ippi'),
	);

	register_taxonomy('publication-type', array('post'), array(
		'hierarchical' => true,
		'labels' => $publication_labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		//'rewrite' => array('slug' => 'publication-type'),
	));
    //End Post post type

    //Posttype Backgrounder
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Backgrounder', 'ippi'),
        'singular_name' => _x('Backgrounder', 'ippi'),
        'menu_name' => _x('Backgrounder', 'ippi'),
        'name_admin_bar' => _x('Backgrounder', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Backgrounder', 'ippi'),
        'new_item' => __('New Backgrounder', 'ippi'),
        'edit_item' => __('Edit Backgrounder', 'ippi'),
        'view_item' => __('View Backgrounder', 'ippi'),
        'all_items' => __('All Backgrounder', 'ippi'),
        'search_items' => __('Search Backgrounder', 'ippi'),
        'not_found' => __('No Backgrounder found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-controls-back',
    );
    register_post_type('backgrounder', $args);

    //Posttype Testimonial
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Testimonials', 'ippi'),
        'singular_name' => _x('Testimonial', 'ippi'),
        'menu_name' => _x('Testimonial', 'ippi'),
        'name_admin_bar' => _x('Testimonial', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Testimonial', 'ippi'),
        'new_item' => __('New Testimonial', 'ippi'),
        'edit_item' => __('Edit Testimonial', 'ippi'),
        'view_item' => __('View Testimonial', 'ippi'),
        'all_items' => __('All Testimonial', 'ippi'),
        'search_items' => __('Search Testimonial', 'ippi'),
        'not_found' => __('No Testimonial found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-testimonial',
    );
    register_post_type('testimonials', $args);

    // Issue areas
    $labels = array(
        'name' => _x('Issue areas', 'ippi'),
        'singular_name' => _x('Issue area', 'ippi'),
        'search_items' => __('Search issue areas', 'ippi'),
        'all_items' => __('All issue areas', 'ippi'),
        'parent_item' => __('Parent issue areas', 'ippi'),
        'parent_item_colon' => __('Parent issue areas:', 'ippi'),
        'edit_item' => __('Edit issue areas', 'ippi'),
        'update_item' => __('Update issue areas'), 'ippi',
        'add_new_item' => __('Add New issue areas', 'ippi'),
        'new_item_name' => __('New issue areas', 'ippi'),
        'menu_name' => __('Issue areas', 'ippi'),
    );
    // Now register the taxonomy Issue areas
    register_taxonomy('issue_areas', array('backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'has_archive' => true,
    ));

    // Taxonomy Topics    
    register_taxonomy('topics', array('post','backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'), array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Topics', 'ippi'),
            'singular_name' => _x('Topics', 'ippi'),
            'search_items' => __('Search Topics', 'ippi'),
            'all_items' => __('All Topics', 'ippi'),
            'parent_item' => __('Parent Topics', 'ippi'),
            'parent_item_colon' => __('Parent Topics:', 'ippi'),
            'edit_item' => __('Edit Topics', 'ippi'),
            'update_item' => __('Update Topics', 'ippi'),
            'add_new_item' => __('Add New Topics', 'ippi'),
            'new_item_name' => __('New Topics Name', 'ippi'),
            'menu_name' => __('Topics', 'ippi'),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));

    // Taxonomy Regions 
    $labels = array(
        'name' => _x('Regions', 'ippi'),
        'singular_name' => _x('Regions', 'ippi'),
        'search_items' => __('Search Regions', 'ippi'),
        'all_items' => __('All Regions', 'ippi'),
        'parent_item' => __('Parent Regions', 'ippi'),
        'parent_item_colon' => __('Parent Regions:', 'ippi'),
        'edit_item' => __('Edit Regions', 'ippi'),
        'update_item' => __('Update Regions', 'ippi'),
        'add_new_item' => __('Add New Regions', 'ippi'),
        'new_item_name' => __('New Regions Name', 'ippi'),
        'menu_name' => __('Regions', 'ippi'),
    );
    // Now register the taxonomy
    register_taxonomy('regions', array('backgrounder','post', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));

    // Taxonomy countries 
    $labels = array(
        'name' => _x('Countries', 'ippi'),
        'singular_name' => _x('Countries', 'ippi'),
        'search_items' => __('Search Countries', 'ippi'),
        'all_items' => __('All Countries', 'ippi'),
        'parent_item' => __('Parent Countries', 'ippi'),
        'parent_item_colon' => __('Parent Countries:', 'ippi'),
        'edit_item' => __('Edit Countries', 'ippi'),
        'update_item' => __('Update Countries', 'ippi'),
        'add_new_item' => __('Add New Countries', 'ippi'),
        'new_item_name' => __('New Countries Name', 'ippi'),
        'menu_name' => __('Countries', 'ippi'),
    );
    // Now register the taxonomy
    register_taxonomy('countries', array('backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));
    //End Posttype Backgrounder

    //Posttype Explainer
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Explainer', 'ippi'),
        'singular_name' => _x('Explainer', 'ippi'),
        'menu_name' => _x('Explainer', 'ippi'),
        'name_admin_bar' => _x('Explainer', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Explainer', 'ippi'),
        'new_item' => __('New Explainer', 'ippi'),
        'edit_item' => __('Edit Explainer', 'ippi'),
        'view_item' => __('View Explainer', 'ippi'),
        'all_items' => __('All Explainer', 'ippi'),
        'search_items' => __('Search Explainer', 'ippi'),
        'not_found' => __('No Explainer found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-format-status',
    );
    register_post_type('explainer', $args);
    //End Posttype Explainer

    //Posttype Podcast
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Podcast', 'ippi'),
        'singular_name' => _x('Podcast', 'ippi'),
        'menu_name' => _x('Podcast', 'ippi'),
        'name_admin_bar' => _x('Podcast', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Podcast', 'ippi'),
        'new_item' => __('New Podcast', 'ippi'),
        'edit_item' => __('Edit Podcast', 'ippi'),
        'view_item' => __('View Podcast', 'ippi'),
        'all_items' => __('All Podcast', 'ippi'),
        'search_items' => __('Search Podcast', 'ippi'),
        'not_found' => __('No Podcast found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-format-audio',
    );
    register_post_type('podcast', $args);
    //End Posttype Podcast

    //Posttype Video
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Video', 'ippi'),
        'singular_name' => _x('Video', 'ippi'),
        'menu_name' => _x('Video', 'ippi'),
        'name_admin_bar' => _x('Video', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Video', 'ippi'),
        'new_item' => __('New Video', 'ippi'),
        'edit_item' => __('Edit Video', 'ippi'),
        'view_item' => __('View Video', 'ippi'),
        'all_items' => __('All Video', 'ippi'),
        'search_items' => __('Search Video', 'ippi'),
        'not_found' => __('No Video found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-format-video',
    );
    register_post_type('video', $args);
    //End Posttype Video

    //Posttype Dossier
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Dossier', 'ippi'),
        'singular_name' => _x('Dossier', 'ippi'),
        'menu_name' => _x('Dossier', 'ippi'),
        'name_admin_bar' => _x('Dossier', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Dossier', 'ippi'),
        'new_item' => __('New Dossier', 'ippi'),
        'edit_item' => __('Edit Dossier', 'ippi'),
        'view_item' => __('View Dossier', 'ippi'),
        'all_items' => __('All Dossier', 'ippi'),
        'search_items' => __('Search Dossier', 'ippi'),
        'not_found' => __('No Dossier found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-media-document',
    );
    register_post_type('dossier', $args);
    //End Posttype Dossier

    //Posttype In the News
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('In the News', 'ippi'),
        'singular_name' => _x('In the News', 'ippi'),
        'menu_name' => _x('In the News', 'ippi'),
        'name_admin_bar' => _x('In the News', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New In the News', 'ippi'),
        'new_item' => __('New In the News', 'ippi'),
        'edit_item' => __('Edit In the News', 'ippi'),
        'view_item' => __('View In the News', 'ippi'),
        'all_items' => __('All In the News', 'ippi'),
        'search_items' => __('Search In the News', 'ippi'),
        'not_found' => __('No In the News found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-welcome-view-site',
    );
    register_post_type('in_the_news', $args);
    //End Posttype In the News

    //Posttype Event
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Event', 'ippi'),
        'singular_name' => _x('Event', 'ippi'),
        'menu_name' => _x('Event', 'ippi'),
        'name_admin_bar' => _x('Event', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Event', 'ippi'),
        'new_item' => __('New Event', 'ippi'),
        'edit_item' => __('Edit Event', 'ippi'),
        'view_item' => __('View Event', 'ippi'),
        'all_items' => __('All Event', 'ippi'),
        'search_items' => __('Search Event', 'ippi'),
        'not_found' => __('No Event found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-location-alt',
    );
    register_post_type('event', $args);

    //texonomy Event type
    $labels = array(
        'name' => _x('Event types', 'ippi'),
        'singular_name' => _x('Event type', 'ippi'),
        'search_items' => __('Search Event type', 'ippi'),
        'all_items' => __('All Event type', 'ippi'),
        'parent_item' => __('Parent Event type', 'ippi'),
        'parent_item_colon' => __('Parent Event type:', 'ippi'),
        'edit_item' => __('Edit Event type', 'ippi'),
        'update_item' => __('Update Event type', 'ippi'),
        'add_new_item' => __('Add New Event type', 'ippi'),
        'new_item_name' => __('New Event type Name', 'ippi'),
        'menu_name' => __('Event types', 'ippi'),
    );

    register_taxonomy('event_types', array('event'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));
    //End Posttype Event

    // Post type Experts
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments');
    $labels = array(
        'name' => _x('Experts', 'ippi'),
        'singular_name' => _x('Experts', 'singular'),
        'menu_name' => _x('Experts', 'ippi'),
        'name_admin_bar' => _x('Experts', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Experts', 'ippi'),
        'new_item' => __('New Experts', 'ippi'),
        'edit_item' => __('Edit Experts', 'ippi'),
        'view_item' => __('View Experts', 'ippi'),
        'all_items' => __('All Experts', 'ippi'),
        'search_items' => __('Search Experts', 'ippi'),
        'not_found' => __('No Experts found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-businessman',
    );
    register_post_type('experts', $args);

    //texonomy Expertise type
    $labels = array(
        'name' => _x('Expertise types', 'ippi'),
        'singular_name' => _x('Expertise type', 'ippi'),
        'search_items' => __('Search Expertise type', 'ippi'),
        'all_items' => __('All Expertise type', 'ippi'),
        'parent_item' => __('Parent Expertise type', 'ippi'),
        'parent_item_colon' => __('Parent Expertise type:', 'ippi'),
        'edit_item' => __('Edit Expertise type', 'ippi'),
        'update_item' => __('Update Expertise type', 'ippi'),
        'add_new_item' => __('Add New Expertise type', 'ippi'),
        'new_item_name' => __('New Expertise type Name', 'ippi'),
        'menu_name' => __('Expertise types', 'ippi'),
    );

    register_taxonomy('expertise', array('experts'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));
    
    //taxonomy Expertise type
    $labels = array(
        'name' => _x('Expert types', 'ippi'),
        'singular_name' => _x('Expert type', 'ippi'),
        'search_items' => __('Search Expert type', 'ippi'),
        'all_items' => __('All Expert type', 'ippi'),
        'parent_item' => __('Parent Expert type', 'ippi'),
        'parent_item_colon' => __('Parent Expert type:', 'ippi'),
        'edit_item' => __('Edit Expert type', 'ippi'),
        'update_item' => __('Update Expert type', 'ippi'),
        'add_new_item' => __('Add New Expert type', 'ippi'),
        'new_item_name' => __('New Expert type Name', 'ippi'),
        'menu_name' => __('Expert types', 'ippi'),
    );

    register_taxonomy('expert-type', array('experts'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));
    // End post type Experts

    // Post type Authors
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments');
    $labels = array(
        'name' => _x('Authors', 'ippi'),
        'singular_name' => _x('Author', 'ippi'),
        'menu_name' => _x('Authors', 'ippi'),
        'name_admin_bar' => _x('Authors', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Author', 'ippi'),
        'new_item' => __('New Author', 'ippi'),
        'edit_item' => __('Edit Author', 'ippi'),
        'view_item' => __('View Author', 'ippi'),
        'all_items' => __('All Author', 'ippi'),
        'search_items' => __('Search Author', 'ippi'),
        'not_found' => __('No Author found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-id',
    );
    register_post_type('authors', $args);
    // End post type Author

    //Post type Projects
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments');
    $labels = array(
        'name' => _x('Projects', 'ippi'),
        'singular_name' => _x('Projects', 'ippi'),
        'menu_name' => _x('Projects', 'ippi'),
        'name_admin_bar' => _x('Projects', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Project', 'ippi'),
        'new_item' => __('New Project', 'ippi'),
        'edit_item' => __('Edit Project', 'ippi'),
        'view_item' => __('View Project', 'ippi'),
        'all_items' => __('All Projects', 'ippi'),
        'search_items' => __('Search Projects', 'ippi'),
        'not_found' => __('No Projects found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-media-default',
    );

    register_post_type('projects', $args);
    // Special Projects Taxonomys

    //End post type Projects

    // Fellowship post type
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Fellowship', 'ippi'),
        'singular_name' => _x('Fellowship', 'ippi'),
        'menu_name' => _x('Fellowship', 'ippi'),
        'name_admin_bar' => _x('Fellowship', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Fellowship', 'ippi'),
        'new_item' => __('New Fellowship', 'ippi'),
        'edit_item' => __('Edit Fellowship', 'ippi'),
        'view_item' => __('View Fellowship', 'ippi'),
        'all_items' => __('All items', 'ippi'),
        'search_items' => __('Search Fellowship', 'ippi'),
        'not_found' => __('No Fellowship found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-groups',
    );
    register_post_type('fellowship', $args);

    $labels = array(
        'name' => _x('Fellowships Categories', 'ippi'),
        'singular_name' => _x('Fellowships Category', 'ippi'),
        'search_items' => __('Search Fellowships Categories', 'ippi'),
        'all_items' => __('All Fellowships Categories', 'ippi'),
        'parent_item' => __('Parent Fellowships Category', 'ippi'),
        'parent_item_colon' => __('Parent Fellowships Category:', 'ippi'),
        'edit_item' => __('Edit Fellowships Category', 'ippi'),
        'update_item' => __('Update Fellowships Category', 'ippi'),
        'add_new_item' => __('Add New Fellowships Category', 'ippi'),
        'new_item_name' => __('New Fellowships Category Name', 'ippi'),
        'menu_name' => __('Fellowships Categories', 'ippi'),
    );

    register_taxonomy('fellowships-category', array('fellowship'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'fellowships-category'),
    ));

    //End Fellowship post type    

    //Jobs and Fellowship post type
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Job and Fellowships', 'ippi'),
        'singular_name' => _x('Job and Fellowship', 'ippi'),
        'menu_name' => _x('Job and Fellowship', 'ippi'),
        'name_admin_bar' => _x('Job and Fellowship', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Job and Fellowship', 'ippi'),
        'new_item' => __('New Job and Fellowship', 'ippi'),
        'edit_item' => __('Edit Job and Fellowship', 'ippi'),
        'view_item' => __('View Job and Fellowship', 'ippi'),
        'all_items' => __('All items', 'ippi'),
        'search_items' => __('Search Job and Fellowship', 'ippi'),
        'not_found' => __('No Job and Fellowship found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-portfolio',
    );
    register_post_type('job_and_fellowship', $args);

    $labels = array(
        'name' => _x('Type', 'ippi'),
        'singular_name' => _x('Type', 'ippi'),
        'search_items' => __('Search Type Categories', 'ippi'),
        'all_items' => __('All Type Categories', 'ippi'),
        'parent_item' => __('Parent Type', 'ippi'),
        'parent_item_colon' => __('Parent Type:', 'ippi'),
        'edit_item' => __('Edit Type', 'ippi'),
        'update_item' => __('Update Type', 'ippi'),
        'add_new_item' => __('Add New Type', 'ippi'),
        'new_item_name' => __('New Type', 'ippi'),
        'menu_name' => __('Type', 'ippi'),
    );

    register_taxonomy('type', array('job_and_fellowship'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));
    //End Jobs and Fellowship post type

    //Post type Programs
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail');
    $labels = array(
        'name' => _x('Programs', 'ippi'),
        'singular_name' => _x('Programs', 'ippi'),
        'menu_name' => _x('Programs', 'ippi'),
        'name_admin_bar' => _x('Programs', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Programs', 'ippi'),
        'new_item' => __('New Programs', 'ippi'),
        'edit_item' => __('Edit Programs', 'ippi'),
        'view_item' => __('View Programs', 'ippi'),
        'all_items' => __('All items', 'ippi'),
        'search_items' => __('Search Programs', 'ippi'),
        'not_found' => __('No Program found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-feedback',
    );
    register_post_type('program', $args);
    //End post type Programs

    // Our Network post type
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',);
    $labels = array(
        'name' => _x('Our Network', 'ippi'),
        'singular_name' => _x('Our Network', 'ippi'),
        'menu_name' => _x('Our Network', 'ippi'),
        'name_admin_bar' => _x('Our Network', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Our Network', 'ippi'),
        'new_item' => __('New Our Network', 'ippi'),
        'edit_item' => __('Edit Our Network', 'ippi'),
        'view_item' => __('View Our Network', 'ippi'),
        'all_items' => __('All items', 'ippi'),
        'search_items' => __('Search Our Network', 'ippi'),
        'not_found' => __('No Our Network found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-networking',
    );
    register_post_type('our-network', $args);

    $labels = array(
        'name' => _x('Areas of Expertise', 'ippi'),
        'singular_name' => _x('Areas of Expertise', 'ippi'),
        'search_items' => __('Search Areas of Expertise', 'ippi'),
        'all_items' => __('All Areas of Expertise', 'ippi'),
        'parent_item' => __('Parent Areas of Expertise', 'ippi'),
        'parent_item_colon' => __('Parent Areas of Expertise:', 'ippi'),
        'edit_item' => __('Edit TaAreas of Expertiseg', 'ippi'),
        'update_item' => __('Update Areas of Expertise', 'ippi'),
        'add_new_item' => __('Add New Areas of Expertise', 'ippi'),
        'new_item_name' => __('New Areas of Expertise Name', 'ippi'),
        'menu_name' => __('Areas of Expertise', 'ippi'),
    );

    register_taxonomy('area-of-expertise', array('our-network'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'area-of-expertise'),
    ));

    $labels = array(
		'name' => _x('Network Categories', 'ippi'),
		'singular_name' => _x('Category', 'ippi'),
		'search_items' => __('Search Network Categories', 'ippi'),
		'all_items' => __('All Category', 'ippi'),
		'parent_item' => __('Parent Network Category', 'ippi'),
		'parent_item_colon' => __('Parent Network Category:', 'ippi'),
		'edit_item' => __('Edit Category', 'ippi'),
		'update_item' => __('Update Category', 'ippi'),
		'add_new_item' => __('Add New Network Category', 'ippi'),
		'new_item_name' => __('New Category Name', 'ippi'),
		'menu_name' => __('Network Categories', 'ippi'),
	);

	register_taxonomy('network-category', array('our-network'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'network-category'),
	));
    //End Our Network post type

    // Post type Partner
    $supports = array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments');
    $labels = array(
        'name' => _x('Partners', 'ippi'),
        'singular_name' => _x('Partner', 'ippi'),
        'menu_name' => _x('Partners', 'ippi'),
        'name_admin_bar' => _x('Partners', 'ippi'),
        'add_new' => _x('Add New', 'ippi'),
        'add_new_item' => __('Add New Partner', 'ippi'),
        'new_item' => __('New Partner', 'ippi'),
        'edit_item' => __('Edit Partner', 'ippi'),
        'view_item' => __('View Partner', 'ippi'),
        'all_items' => __('All items', 'ippi'),
        'search_items' => __('Search Partners', 'ippi'),
        'not_found' => __('No Partner found.', 'ippi'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-groups',
    );
    register_post_type('partner', $args);
    //End Post type Partner

}