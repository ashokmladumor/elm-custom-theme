<?php
$section_heading = $settings['section_heading'];
$include_term_ids = $settings['include_issue_are_ids'];
$section_slide_count = $settings['section_slide_count'];
$overview_switcher = $settings['overview_switcher'];
$topics_switcher = $settings['topics_switcher'];
$rand_id = rand(1, 1000);

if (is_single()) {
    $term_obj_list = get_the_terms($post->ID, 'issue_areas');
    $include_term_ids = wp_list_pluck($term_obj_list, 'term_id');
}


if ($include_term_ids) {
    ?>
    <!--====== HTML CODING START ========-->

    <div class="ippi-issue-areas">
        <div class="ippi-issue-areas-wrapper ippi-container">
            <?php if ($include_term_ids) { ?>
                <div class="ippi-issue-areas-slider-<?php echo $rand_id; ?> ippi-issue-areas-slider slick-slider"
                     slider-id="<?php echo $rand_id; ?>">
                    <?php
                    $count = 1;
                    foreach ($include_term_ids as $term_id) :

                        $term = get_term($term_id);
                        $id = $term->term_id;
                        $description = $term->description;
                        $title = $term->name;
                        $image = get_field('featured_image', $term);
                        $related_topics = get_field('topics', $term);
                        if (!$image) {
                            $image = get_stylesheet_directory_uri() . '/assets/images/no-image.png';
                        }

                        if ("0" == $section_slide_count) {
                            break;
                        }
                        ?>
                        <?php if ($term_id && $term)  { ?>
                        <div class="ippi-grid-col-1/2- ippi-issue-areas-item">
                            <div class="ippi-issue-areas-item-wrapper">
                                <div class="ippi-issue-areas-item-image">
                                    <a href="<?php echo get_term_link($term); ?>">
                                        <img src="<?php echo $image; ?>" alt="<?php _e($title, 'ippi'); ?>">
                                    </a>
                                </div>
                                <div class="ippi-issue-areas-item-content-area ">
                                    <div class="ippi-issue-areas-item-heading">
                                        <a href="<?php echo get_term_link($term); ?>">
                                            <h3 class="ippi-issue-area-title"
                                                style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/arrow.png' ?>);">
                                                <?php _e($title, 'ippi'); ?>
                                            </h3>
                                        </a>
                                    </div>
                                    <?php if ($overview_switcher): ?>
                                        <div class="ippi-issue-area-description">
                                            <p><?php _e($description, 'ippi'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($related_topics && $topics_switcher) : ?>
                                        <div class="ippi-issue-areas-topics">
                                            <?php
                                            foreach ($related_topics as $topic) {
                                                if (!is_object(get_term_link($topic) && $topic)) {
                                                    ?>
                                                    <a class="ippi-issue-areas-topic-tag ippi-btn-hover-black-left elementor-button-link elementor-button elementor-size-sm"
                                                       href="<?php echo get_term_link($topic); ?>"><?php _e($topic->name, 'ippi'); ?></a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                        if ($count == $section_slide_count) {
                            break;
                        }

                        $count++;
                    endforeach;
                    ?>
                </div>

                <div class="custom_paging">
                    <div class="ippi-issue-areas-slick-prev ippi-issue-areas-slick-prev-<?php echo $rand_id; ?>"
                         style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                    <!-- <p><span class="current-slide-count">1</span> of <span class="all-slide-count"><?php _e($query->post_count, 'ippi') ?></span></p> -->
                    <div class="ippi-issue-areas-slick-next ippi-issue-areas-slick-next-<?php echo $rand_id; ?>"
                         style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--========== HTML CODING END============-->
    <style>

    </style>

    <?php

    wp_reset_postdata();
}
