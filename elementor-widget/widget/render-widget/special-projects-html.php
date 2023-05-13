<?php
$section_heading = $settings['section_heading'];
$featured_content_selected_posts = $settings['spacial_project_selected_posts'];
$include_term_ids = $settings['include_term_ids'];
$section_slide_count = $settings['section_slide_count'];
$related_activity = $settings['spacial_project_related_activity'];
$spacial_project_status = $settings['spacial_project_status'];
$related_experts = $settings['related_experts'];
$recency_and_popularity = $settings['recency_and_popularity'];
$query = [];


$related_projects = [];

if(get_field('related_projects', get_the_ID())) {
    foreach(get_field('related_projects', get_the_ID()) as $projects){
        $related_projects[] = $projects->ID;
    }
}

if ($featured_content_selected_posts || $related_projects) {
    $args = array(
        'post_status' => 'publish',
        'post_type' =>  array('backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'),
        'posts_per_page' => ($related_projects) ? count($related_projects) : $section_slide_count,
        'post__in' => ($related_projects) ? $related_projects : $featured_content_selected_posts,
        'order' => 'DESC',
    );
    $query = new WP_Query($args);
} else {

    $current_post_id =  get_the_ID();
    $related_act = [];
    if ($related_activity) {
        foreach ($related_activity as $activity) {
            //print_r(array_column(get_field($activity, $current_post_id), 'ID'));
            @$new_act = array_merge($related_act, array_column(get_field($activity, $current_post_id), 'ID')); 
            // echo '++++ <pre>';
            // print_r($new_act);
            // echo '</pre>';
            $related_act = $new_act;
        }
    }


  

    $args = array(
        'post_status' => 'publish',
        'post_type' =>  array('backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'),
        'posts_per_page' => -1,
        'post__in' => $related_act,
        'fields' => 'ids',
        'tax_query' => array(
            'relation' => 'OR',
        ),
        'order' => 'DESC',
        'meta_query' => array(
            'relation' => 'OR',
        )
    );
    // $terms = [];
    if ($include_term_ids) {
        foreach ($include_term_ids as $term_id) {
            $term = get_term($term_id);
            $term_array[$term->taxonomy][] = $term_id;
            $args['tax_query'][$term->taxonomy] = array(
                'taxonomy' => $term->taxonomy,
                'field' => 'id',
                'terms' => $term_array[$term->taxonomy],
            );
        }
    }
    if ($spacial_project_status) {
        $args['meta_query']['status'] = array(
        'key' => 'program_status',
        'value' => $spacial_project_status,
        );
    }
    $query = get_posts($args);
    $matched_post = $query;
    if ($related_experts && count($related_experts) > 0 && $query > 0) {
        $matched_post = [];
        foreach ($related_experts as $experts) {
            @$selected_experts = array_column(get_field($experts, $current_post_id), 'ID');

            if ($selected_experts > 0) {
                foreach ($query as $post_id) {
                    $matched = [];
                    @$other_selected_experts = array_column(get_field($experts, $post_id), 'ID');
                    if ($other_selected_experts && count($other_selected_experts) > 0 && $selected_experts  && count($selected_experts) > 0) {
                        $matched = array_intersect($other_selected_experts, $selected_experts);
                    }
                    if (count($matched) > 0) {
                        $matched_post[$post_id] = $post_id;
                    }
                }
            }
        }
    }

    $query  = [];
    // echo '=======================================';
    // echo '<pre>';
    // print_r($matched_post);
    // echo '</pre>';

    if (count($matched_post) > 0) {
        $args = array(
            'post_status' => 'publish',
            'post_type' =>  array('backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'),
            'posts_per_page' => $section_slide_count,
            'post__in' => $matched_post,
            // 'meta_key' => 'wp_post_views_count', // set custom meta key
            'orderby' => 'name',
            'order' => 'ASC',
        );
        if ($recency_and_popularity == 'recency') {
            $args['orderby'] = 'name';
            $args['order'] = 'DESC';
        } else if ($recency_and_popularity == 'popularity') {
            $$args['meta_key'] = 'wp_post_views_count'; // set custom meta key
            $$args['orderby'] = 'meta_value_num';
        }
        $query = new WP_Query($args);
    }
}

// echo '<pre>';
// print_r($query);
// echo '</pre>';
$rand_id = rand(1, 1000);
if ($query->post_count > 0) {
    ?>
    <!--====== HTML CODING START ========-->


    <div class="ippi-spacial-project">
        <div class="ippi-container">
            <h2 class="ippi-spacial-project-section-title"><?php echo $section_heading; ?></h2>
        </div>
        <div class="ippi-spacial-project-wrapper">
            <?php if ($query->post_count > 0) { ?>
                <div class="ippi-spacial-project-slider-<?php echo $rand_id; ?> ippi-spacial-project-slider -owl-carousel slick-slider -owl-theme" slider-id="<?php echo $rand_id; ?>">
                    <?php

                    while ($query->have_posts()) : $query->the_post();
                        $post = get_post();
                        $id = get_the_ID();
                        $image = get_the_post_thumbnail_url($post, 'full');
                        if (!$image) {
                            $image = get_stylesheet_directory_uri() . '/assets/images/no-image.png';
                        }
                        //$post = get_queried_object();
                        $postType = get_post_type_object(get_post_type($post));
                        ?>
                        <div class="ippi-grid-col-1/2- ippi-spacial-project-item">
                            <div class="ippi-spacial-project-item-wrapper">
                                <div class="ippi-spacial-project-item-content-area ">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <div class="ippi-spacial-project-item-heading">
                                            <h3 class="ippi-spacial-project-item-title">
                                                <span class="ippi-spacial-project-item-content-type"><?php _e($postType->labels->singular_name, 'ippi'); ?> <?php _e('|', 'ippi');?></span>
                                                <span class="ippi-spacial-project-item-title-main"> <?php echo get_the_title(); ?> </span>
                                            </h3>
                                            
                                        </div>
                                        <div class="ippi-spacial-project-item-description">
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 15, ''); ?></p>
                                        </div>
                                        <div class="ippi-special-project-item-date"><?php echo get_the_date();?></div>
                                    </a>
                                </div>
                                <div class="ippi-spacial-project-item-image" style="background-image: url(<?php echo $image; ?>)">
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;

                    ?>
                </div>

                <div class="custom_paging">
                    <div class="ippi-spacial-project-prev ippi-spacial-project-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/arrow.png' ?>)"></div>
                    <p><span class="current-slide-count current-slide-count-<?php echo $rand_id; ?>"><?php _e('1', 'ippi'); ?></span> <?php _e('of', 'ippi'); ?> <span class="all-slide-count all-slide-count-<?php echo $rand_id; ?>"><?php _e($query->post_count, 'ippi'); ?></span></p>
                    <div class="ippi-spacial-project-next ippi-spacial-project-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/arrow.png' ?>)"></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php

    wp_reset_postdata();
}
