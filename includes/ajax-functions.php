<?php
function get_ajax_reports()
{

	$current_page = $_POST['current_page'];
	$post_per_page = intval($_POST['post_per_page']);
	$paged = intval($_POST['paged']);
	$offset = ($paged - 1) * $post_per_page + 1;
    
	$args = array(
		'post_type' => array('post-report'),
        //'post_status' => 'publish',
        'posts_per_page' => $post_per_page,
        'paged' => $paged,
		'offset' => $offset,
	);

	if(is_archive()) {
        // get current taxonomy id
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'issue_areas',
                'field' => 'id',
                'terms' => array(get_queried_object()->term_id),
            )
        );
    }

	$the_query = new WP_Query($args);


	$html = '';
	if ($the_query->have_posts()) :

		while ($the_query->have_posts()) : $the_query->the_post();
            $id = get_the_ID();
            $image = get_the_post_thumbnail($id, 'full');                   
            $term_obj_list = get_the_terms( get_the_ID(), 'report-category' );
            $report_terms = join(', ', wp_list_pluck($term_obj_list, 'name'));
            $display_terms = ( $report_terms ) ? $report_terms . " | " : '';
			ob_start();
			include( get_stylesheet_directory() . '/elementor-widget/widget/render-widget/template-part/recent-report-loop-item.php');     
			$html .=ob_get_clean(); 

		endwhile;
		wp_reset_postdata();
  
	endif;
	echo json_encode(array('r' => 'success', 'html' => $html));
	wp_die();
}
add_action('wp_ajax_get_ajax_reports', 'get_ajax_reports');
add_action('wp_ajax_nopriv_get_ajax_reports', 'get_ajax_reports');

