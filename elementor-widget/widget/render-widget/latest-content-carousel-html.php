<?php

//echo '<pre>';
//print_r($settings);
//echo '</pre>';

$section_heading = $settings['section_heading'];
$latest_content_selected_posts = $settings['latest_content_selected_posts'];
$section_carousel_or_grid = $settings['section_carousel_or_grid'];

$specific_content_type[] = $settings['specific_content_type[0]'];
$specific_content_type[] = $settings['specific_content_type[1]'];
$specific_content_type[] = $settings['specific_content_type[2]'];
$specific_content_type[] = $settings['specific_content_type[3]'];
$specific_content_type[] = $settings['specific_content_type[4]'];
$specific_content_type[] = $settings['specific_content_type[5]'];
$specific_content_type[] = $settings['specific_content_type[6]'];
$specific_content_type[] = $settings['specific_content_type[7]'];

$related_activity = $settings['related_activity'];
$activity_status = $settings['activity_status'];
$related_experts = $settings['related_experts'];
$recency_and_popularity = $settings['recency_and_popularity'];
$title = (isset($settings['title'])) ? $settings['title'] : '';
$link = (isset($settings['link'])) ? $settings['link'] : '';
$all_post_type = array('post', 'backgrounder', 'fellowship', 'projects', 'program', 'in_the_news', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship');
$featured_publications = get_field('featured_publications', get_the_ID());
$post_types =  (array_intersect($all_post_type, $specific_content_type) && count(array_intersect($all_post_type, $specific_content_type)) > 0) ? array_intersect($all_post_type, $specific_content_type) : $all_post_type;
$section_slide_count = 10;
$query = [];

//$get_related_content_ids = get_field('related_content', get_the_ID());
if ($latest_content_selected_posts || $get_related_content_ids || $featured_publications) {
    $args = array(
        'post_status' => 'publish',
        'post_type' =>  $all_post_type,
        //  'post__in' => $get_related_content_ids ?? $latest_content_selected_posts,
        'post__in' => $featured_publications ? $featured_publications : $latest_content_selected_posts,
    );

    $query = new WP_Query($args);
} else {
    $current_post_id =  get_the_ID();
    $related_act = [];
    if ($related_activity) {
        foreach ($related_activity as $activity) {
            @$new_act = array_merge($related_act, array_column(get_field($activity, $current_post_id), 'ID'));
            $related_act = $new_act;
        }
    }
    $args = array(
        'post_status' => 'publish',
        'post_type' =>  $post_types,
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

    if ($activity_status) {
        $args['meta_query']['status'] = array(
            'key' => 'program_status',
            'value' => $activity_status,
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

    if (count($matched_post) > 0) {
        $args = array(
            'post_status' => 'publish',
            'post_type' => $post_types,
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
//$view = "View All";
$rand_id = rand(1, 1000);
if ($query->post_count > 0) {
?>
    <!--====== HTML CODING START ========-->


    <div class="ippi-latest-content">
        <div class="ippi-container">
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

        <div class="ippi-latest-content-wrapper ippi-container">
            <div class=" <?php echo ($section_carousel_or_grid == 'yes') ? 'ippi-latest-content-slider' . $rand_id . ' ippi-latest-content-slider slick-slider' : ''; ?>" onload="call_slick_slider()" slider-id="<?php echo $rand_id; ?>">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    $id = get_the_ID();
                    $image = get_the_post_thumbnail_url($post, 'full');
                    if (!$image) {
                        $image = get_stylesheet_directory_uri() . '/assets/images/no-image.png';
                    }
                    $item_icon = '';
                    if (get_post_type($id) == 'video') {
                        $item_icon = get_stylesheet_directory_uri() . '/assets/images/video-icon.svg';
                    } else if (get_post_type($id) == 'podcast') {
                        $item_icon = get_stylesheet_directory_uri() . '/assets/images/podcast-icon.svg';
                    }
                    $postType = get_post_type_object(get_post_type($post));

                ?>
                    <div class="ippi-grid-col-1/2- ippi-latest-content-item">
                        <a href="<?php echo get_the_permalink() ?>">
                            <div class="ippi-latest-content-item-wrapper">
                                <div class="ippi-latest-content-item-image">
                                    <img src="<?php echo $image; ?>">
                                    <?php if ($item_icon) { ?>
                                        <div class="ippi-latest-content-item-icon" style="background-image: url(<?php echo $item_icon; ?>)"></div>
                                    <?php } ?>
                                </div>
                                <div class="ippi-latest-content-item-content-area ">
                                    <div class="ippi-latest-content-item-heading">
                                        <h3 class="ippi-latest-content-item-title">
                                            <span class="ippi-latest-content-item-content-type"><?php _e($postType->labels->singular_name, 'ippi'); ?><?php _e('|', 'ippi'); ?></span>
                                            <span class="ippi-latest-content-item-title-main"> <?php echo get_the_title(); ?> </span>
                                        </h3>
                                    </div>
                                    <div class="ippi-latest-content-item-description">
                                        <p><?php echo wp_trim_words(get_the_content(), 15, ''); ?></p>
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
        </div>
    </div>
    <!--========== HTML CODING END============-->
<?php

    wp_reset_postdata();
}
?>
<style>
    .ippi-view-link-title a {
        top: 14%;
    }
</style>