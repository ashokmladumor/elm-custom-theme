<?php
$section_heading = $settings['section_heading'];
$featured_content_selected_posts = $settings['featured_content_selected_posts'];
$section_heading_toggle = $settings['section_heading_toggle'];

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
$all_post_type = array('post', 'backgrounder', 'fellowship', 'projects', 'program', 'in_the_news', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship');
$featured_publications = get_field('featured_publications', get_the_ID());
// echo '<pre>';
// print_r($featured_publications);
// echo '</pre>';


$post_types =  (array_intersect($all_post_type, $specific_content_type) && count(array_intersect($all_post_type, $specific_content_type)) > 0) ? array_intersect($all_post_type, $specific_content_type) : $all_post_type;
$section_slide_count = 10;
$query = [];
if ($featured_content_selected_posts || $featured_publications) {
    $args = array(
        'post_status' => 'publish',
        'post_type' =>  $all_post_type,
        'post__in' => $featured_publications ? $featured_publications : $featured_content_selected_posts,
        'suppress_filters' => true,
        'orderby' => 'date',
        'order' => 'ASC',

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

$have_two_post = true;

if ($query->post_count > 2) {
    $have_two_post = false;
}
// echo '<pre>';
// print_r($query);
// echo '</pre>';
if ($query) {
?>
    <div class="ippi-featured-content">
        <?php if ($section_heading_toggle == 'yes') { ?>
            <div class="ippi-container ippi-featured-content-have-heading">
                <h2><?php _e($section_heading, 'ippi'); ?></h2>
            </div>
        <?php } ?>
        <div class="ippi-featured-content-container ippi-container">
            <div class="ippi-featured-content-wrapper <?php echo (!$have_two_post && $section_heading_toggle != 'yes') ? ' -ippi-mt-70' : ''; ?>">
                <div class="ippi-grid-wrapper">
                    <div class="ippi-grid-row ippi-fetured-content-float-container">
                        <?php
                        $count = 1;

                        while ($query->have_posts()) : $query->the_post();
                            $post = get_post();
                            $id = get_the_ID();
                            $image = get_the_post_thumbnail($post, 'full');
                            $item_icon = '';
                            if (get_post_type($id) == 'video') {
                                $item_icon = get_stylesheet_directory_uri() . '/assets/images/video-icon.svg';
                            } else if (get_post_type($id) == 'podcast') {
                                $item_icon = get_stylesheet_directory_uri() . '/assets/images/podcast-icon.svg';
                            }
                            $postType = get_post_type_object(get_post_type($post));
                            if (!$have_two_post) {
                                if ($count == 2) {
                        ?>
                                    <div class="ippi-grid-col-1/2 ippi_featured-content-right-main">
                                        <div class="ippi_featured-content-right">
                                            <div class="ippi-grid-wrapper <?php echo ($section_heading_toggle != 'yes') ? ' ippi-pt-40' : ''; ?>">
                                                <div class="ippi-grid-row <?php echo ($section_heading_toggle == 'yes') ? ' -ippi-mt-15' : ''; ?>">
                                            <?php
                                        }
                                    }
                                            ?>
                                            <div class="ippi-grid-col-1/2 ippi-featured-content-item <?php if (!$have_two_post && $count == 1) {
                                                                                                            echo ' ippi_featured-content-left';
                                                                                                        } ?>">
                                                <a href="<?php echo get_the_permalink() ?>">
                                                    <div class="ippi-featured-content-item-wrapper <?php if (!$have_two_post && $count == 1) {
                                                                                                        echo ' ippi_featured-content-first';
                                                                                                    } ?>">
                                                        <div class="ippi-featured-content-item-image">
                                                            <?php if ($image) {
                                                                _e($image, 'ippi'); ?>
                                                            <?php  } else { ?>
                                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/no-image.png" alt="<?php the_title(); ?>" />


                                                            <?php } ?>
                                                            <?php if ($item_icon) { ?>
                                                                <div class="ippi-featured-content-item-icon" style="background-image: url(<?php _e($item_icon, 'ippi'); ?>)"></div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="ippi-featured-content-item-content-area">
                                                            <div class="ippi-featured-content-item-heading">
                                                                <h3 class="ippi-featured-content-item-title">
                                                                    <span class="ippi-featured-content-item-content-type"><?php _e($postType->labels->singular_name, 'ippi'); ?> <?php _e('|', 'ippi'); ?></span>
                                                                    <span class="ippi-featured-content-item-title-main"><?php _e(get_the_title(), 'ippi'); ?> </span>
                                                                </h3>
                                                            </div>
                                                            <div class="ippi-featured-content-item-description">
                                                                <p><?php 
                                                                if ($count == 1) {
                                                                    echo wp_trim_words(get_the_excerpt(),40, ''); 
                                                                } else {
                                                                    echo wp_trim_words(get_the_excerpt(),15, ''); 
                                                                }
                                                                
                                                                
                                                                ?></p>
                                                            </div>
                                                            <div class="ippi-featured-content-item-details">
                                                                <span class="ippi-featured-content-item-date"> <?php echo get_the_date(); ?></span>
                                                                <span class="ippi-featured-content-item-view-count"> <?php _e(get_field('reading_time'), 'ippi'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                            if (!$have_two_post) {
                                                if ($count == $query->post_count) {
                                            ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                                }
                                            }

                                            $count++;
                                        endwhile;

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // jQuery(document).ready(function() {
        //     var offsetHeight = jQuery(document).find('.ippi_featured-content-first').height();
        //     jQuery('.ippi_featured-content-right').height(offsetHeight + 100);
        // });
    </script>
    
<?php

    wp_reset_postdata();
}
