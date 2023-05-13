<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$selected_experts = $settings['selected_experts'];
$section_carousel_or_grid = $settings['section_carousel_or_grid'];
$related_experts = get_field('related_experts', get_the_ID());
$recency_and_popularity = $settings['recency_and_popularity'];
$related_activity = $settings['related_activity'];
$title = (isset($settings['title'])) ? $settings['title'] : '';
$link = (isset($settings['link'])) ? $settings['link'] : '';
$query = [];
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
if ($selected_experts || $related_experts) {
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'any',
        'post__in' => $related_experts ? $related_experts : (($selected_experts) ? $selected_experts : []),
        'orderby' => 'date',
        'order' => 'ASC',
    );

    if ($recency_and_popularity == 'recency') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } else if ($recency_and_popularity == 'popularity') {
        $args['meta_key'] = 'wp_post_views_count'; // set custom meta key
        $args['orderby'] = 'meta_value_num';
    }

    $query = new WP_Query($args);
} else {
    $related_args = array(
        'post_status' => 'publish',
        'post_type' => $related_activity,
        'orderby' => 'date',
        'order' => 'ASC',
        'fields' => 'ids',
        'posts_per_page' => -1,
    );
    $post_ids = get_posts($related_args);
    $expert_list = [];

    foreach ($post_ids as $post_id) {
        $selected_expert = get_field('related_experts', $post_id);
        if ($selected_expert) {
            foreach ($selected_expert as $exp_id) {
                $expert_list[$exp_id] = $exp_id;
            }
        }
    }

    $args = array(
        'post_status' => 'publish',
        'post_type' => 'any',
        'post__in' => $expert_list,
        'orderby' => 'date',
        'order' => 'ASC',
    );

    if ($recency_and_popularity == 'recency') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } else if ($recency_and_popularity == 'popularity') {
        $args['meta_key'] = 'wp_post_views_count'; // set custom meta key
        $args['orderby'] = 'meta_value_num';
    }
    $query = new WP_Query($args);
}

$rand_id = rand(1, 1000);
//$view = "View All";
if ($query) {
?>
    <!--====== HTML CODING START ========-->

    <div class="ippi-experts-carousel ippi-container">
        <!-- <div class="ippi-container ippi-view-all-expert">
            <h2 class="ippi-experts-carousel-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
            <a class="ippi-content-view-all" href="#"><?php //_e($view, 'ippi'); ?></a>
        </div> -->
        <div class="">
            <div class="ippi-content-view-all">
                <h2 class="ippi-latest-content-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
                <!-- <a class="ippi-content-view-all" href="#"><?php //_e($view, 'ippi'); 
                                                                ?></a> -->
                <div class="ippi-view-link-title">
                    <?php if (!empty($settings['link']['url'])) {
                        $this->add_link_attributes('link', $settings['link']);
                    } ?>
                    <a class="ippi-view-link-tag" href="<?php echo $link['url']; ?>" <?php echo ($link['is_external']) ? 'target="_blank"' : '' ?>>
                        <span class="ippi-view-link-title"> <?php _e($title, 'ippi'); ?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="ippi-experts-carousel-wrapper">
            <div class=" <?php echo ($section_carousel_or_grid == 'yes') ? 'ippi-experts-carousel-slider-' . $rand_id . ' ippi-experts-carousel-slider slick-slider' : ' ippi-grid-row'; ?>" slider-id="<?php echo $rand_id ?>">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    $id = get_the_ID();
                    $image = get_the_post_thumbnail_url($post, 'full');

                    $designation = get_field('designation', get_the_ID());
                    $expert_term = get_the_terms($post, 'expertise');
                    $term_name = [];
                    foreach ($expert_term as $terms) {
                        $term_name[] = $terms->slug;
                    }

                    // echo '<pre>';
                    // print_r($term_name);
                    // echo '</pre>';

                    $expertise_query = [];

                    if ($term_name) {
                        $args = array(
                            'post_status' => 'publish',
                            'post_type' => 'any',
                            'posts_per_page' => 3,
                            'tax_query' => array(
                                'relation' => 'OR',
                                array(
                                    'taxonomy' => 'issue_areas',
                                    'field' => 'slug',
                                    'terms' => $term_name,
                                ),
                            ),
                        );
                        $expertise_query = new WP_Query($args);
                    }
                    // 'designation'
                    if (!$image) {
                        $image = get_stylesheet_directory_uri() . '/assets/images/no-user.png';
                    }

                ?>
                    <div class="<?php echo ($section_carousel_or_grid == 'yes') ? '' : 'ippi-grid-col-1/3'; ?> ippi-experts-carousel-item">

                        <div class="ippi-experts-carousel-item-wrapper">
                            <a href="<?php echo get_the_permalink() ?>">
                                <div class="ippi-experts-carousel-item-details">
                                    <div class="ippi-experts-carousel-item-image-container">
                                        <div class="ippi-experts-carousel-item-image" style="background-image: url(<?php echo $image; ?>)">
                                        </div>
                                    </div>
                                    <div class="ippi-experts-carousel-item-content-area ">
                                        <div class="ippi-experts-carousel-item-heading">
                                            <h3 class="ippi-experts-carousel-item-title">
                                                <?php echo get_the_title(); ?>
                                            </h3>
                                        </div>
                                        <p class="ippi-experts-carousel-item-designation"><?php _e($designation, 'ippi'); ?></p>

                                        <p class="ippi-experts-carousel-item-expertise">
                                            <?php
                                            $count = 0;
                                            foreach ($expert_term as $terms) {
                                                echo ($count) ? ', ' : '';
                                                _e($terms->name, 'ippi');
                                                $count++;
                                            } ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="ippi-experts-carousel-item-description">
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                            </a>
                            <div class="ippi-experts-carousel-item-posts">
                                <?php


                                foreach ($expertise_query->posts as $_post) {
                                    $postType = get_post_type_object(get_post_type($_post)); ?>
                                    <div class="ippi-experts-carousel-item-post-heading">
                                        <a href="<?php echo get_the_permalink($_post->ID); ?>">
                                            <h3>
                                                <span class="ippi-experts-carousel-item-post-type"><?php _e($postType->labels->singular_name, 'ippi'); ?> <?php _e('|', 'ippi'); ?></span>
                                                <span class="ippi-experts-carousel-item-post-title"><?php _e($_post->post_title, 'ippi'); ?></span>
                                            </h3>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                <?php
                endwhile;
                ?>
            </div>
            <div class="custom_paging">
                <div class="ippi-experts-carousel-slide-prev ippi-experts-carousel-slide-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                <!-- <p><span class="current-slide-count">1</span> of <span class="all-slide-count"><?php echo $query->post_count ?></span></p> -->
                <div class="ippi-experts-carousel-slide-next ippi-experts-carousel-slide-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
            </div>
        </div>
    </div>




    <!--========== HTML CODING END============-->
<?php
    wp_reset_postdata();
}
