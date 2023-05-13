<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$featured_content_selected_posts = $settings['spacial_project_selected_posts'];
$include_term_ids = (isset($settings['include_term_ids'])) ? $settings['include_term_ids'] : '';
$section_slide_count = (isset($settings['section_slide_count'])) ? $settings['section_slide_count'] : '';
//$related_activity = $settings['spacial_project_related_activity'];
//$spacial_project_status = $settings['spacial_project_status'];
//$related_experts = $settings['related_experts'];
//$recency_and_popularity = $settings['recency_and_popularity'];
$query = [];

if ($featured_content_selected_posts) {
    $args = array(
        'post_status' => 'publish',
        'post_type' =>  array('explainer'),
        'posts_per_page' => $section_slide_count,
        'post__in' => $featured_content_selected_posts,
        'order' => 'DESC',
    );
    $query = new WP_Query($args);
} else {

    $current_post_id =  get_the_ID();
    // $related_act = [];
    // foreach($related_activity as $activity){
    //     @$new_act = array_merge($related_act, array_column(get_field($activity, $current_post_id), 'ID'));
    //     $related_act = $new_act;
    // }
    $args = array(
        'post_status' => 'publish',
        'post_type' =>  array('explainer'),
        'posts_per_page' => -1,
        'post__in' => $related_act,
        'fields' => 'ids',
        'tax_query' => array(
            'relation' => 'AND',
        ),
        'order' => 'DESC',
        'meta_query' => array(
            'relation' => 'OR',
        )
    );
    // $terms = [];
    foreach ($include_term_ids as $term_id) {
        $term = get_term($term_id);
        $term_array[$term->taxonomy][] = $term_id;
        $args['tax_query'][$term->taxonomy] = array(
            'taxonomy' => $term->taxonomy,
            'field' => 'id',
            'terms' => $term_array[$term->taxonomy],
        );
    }

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

    // $args['meta_query']['status'] = array(
    //     'key' => 'program_status',
    //     'value' => $spacial_project_status,
    // );
    $query = get_posts($args);
    $matches_post = $query;
    // if (count($related_experts) > 0 && $query > 0) {
    //     $matches_post = [];
    //     foreach ($related_experts as $experts) {
    //         @$selected_esperts = array_column(get_field($experts, $current_post_id), 'ID'); 

    //         if($selected_esperts > 0) {
    //             foreach($query as $post_id){
    //                 $matchs = [];
    //                 @$other_selected_esperts = array_column(get_field($experts, $post_id), 'ID');
    //                 if($other_selected_esperts && count($other_selected_esperts) > 0 && $selected_esperts  && count($selected_esperts) > 0 ) {
    //                     $matchs = array_intersect($other_selected_esperts, $selected_esperts);
    //                 }
    //                 if(count($matchs) > 0) {
    //                     $matches_post[$post_id] = $post_id;
    //                 }
    //             }
    //         }
    //     }
    // }

    $query  = [];

    if (count($matches_post) > 0) {
        $args = array(
            'post_status' => 'publish',
            'post_type' =>  array('explainer'),
            'posts_per_page' => $section_slide_count,
            'post__in' => $matches_post,
            // 'meta_key' => 'wp_post_views_count', // set custom meta key
            'orderby' => 'name',
            'order' => 'ASC',
        );
        // if ($recency_and_popularity == 'recency') {
        //     $args['orderby'] = 'name';
        //     $args['order'] = 'DESC';  
        // }else if($recency_and_popularity == 'popularity') {
        //     $$args['meta_key'] = 'wp_post_views_count';// set custom meta key
        //     $$args['orderby'] = 'meta_value_num';
        // }
        $query = new WP_Query($args);
    }
}

$rand_id = rand(1, 1000);
if ($query->post_count > 0) {
?>
    <!--====== HTML CODING START ========-->


    <div class="ippi-latest-content">
        <div class="ippi-container">
            <h2 class="ippi-latest-content-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
        <div class="ippi-latest-content-wrapper ippi-container">
            <?php if ($query->post_count > 0) { ?>
                <div class="ippi-latest-content-slider'.$rand_id.' ippi-latest-content-slider slick-slider" slider-id="<?php echo $rand_id; ?>">
                    <?php

                    while ($query->have_posts()) : $query->the_post();
                        $post = get_post();
                        $id = get_the_ID();
                        $image = get_the_post_thumbnail_url($post, 'full');
                        if (!$image) {
                            $image = get_stylesheet_directory_uri() . '/assets/images/no-image.png';
                        }
                    ?>
                        <div class="ippi-grid-col-1/2- ippi-latest-content-item">
                            <a href="<?php echo get_the_permalink() ?>">
                                <div class="ippi-latest-content-item-wrapper">
                                    <div class="ippi-latest-content-item-image">
                                        <img src="<?php _e($image, 'ippi'); ?>">
                                    </div>
                                    <div class="ippi-latest-content-item-content-area ">
                                        <div class="ippi-latest-content-item-heading">
                                            <h3 class="ippi-latest-content-item-title">
                                                <span class="ippi-latest-content-item-content-type"><?php echo get_post_type($id) . ' | '; ?></span>
                                                <span class="ippi-latest-content-item-title-main"> <?php echo get_the_title(); ?> </span>
                                            </h3>
                                        </div>
                                        <div class="ippi-latest-content-item-description">
                                            <p><?php echo get_the_excerpt(); ?></p>
                                        </div>
                                        <div class="ippi-latest-content-item-details">
                                            <span class="ippi-latest-content-item-date"> <?php echo get_the_date(); ?></span>
                                            <span class="ippi-latest-content-item-view-count"> <?php echo (get_field('reading_time')) ? get_field('reading_time') : '0 Minute'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    endwhile;

                    ?>
                </div>

                <div class="custom_paging">
                    <div class="ippi-latest-content-slick-prev ippi-latest-content-slick-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                    <!-- <p><span class="current-slide-count">1</span> of <span class="all-slide-count"><?php echo $query->post_count ?></span></p> -->
                    <div class="ippi-latest-content-slick-next ippi-latest-content-slick-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--========== HTML CODING END============-->
    <script>
        var rtl = false;
        if (jQuery('body').hasClass('rtl')) {
            rtl = true;
        }
        jQuery(document).ready(function() {

            var slider_id = jQuery('.ippi-latest-content-slider').attr('slider-id');

            jQuery('.ippi-latest-content-slider').slick({
                slidesToShow: 3,
                // centerMode: true,
                slidesToScroll: 3,
                speed: 300,
                infinite: true,
                autoplay: true,
                adaptiveHeight: true,
                rtl: rtl,
                dots: true,
                nextArrow: jQuery('.ippi-latest-content-slick-next'),
                prevArrow: jQuery('.ippi-latest-content-slick-prev'),
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 2,
                            // slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 960,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]

            });


        });
    </script>

<?php

    wp_reset_postdata();
}