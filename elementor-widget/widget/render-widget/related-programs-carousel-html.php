<?php

// echo '<pre>';
// print_r(get_field('related_programs', get_the_ID()));
// echo '</pre>';
$program_ids = [];
if(get_field('related_programs', get_the_ID())) {
    foreach(get_field('related_programs', get_the_ID()) as $programs){
        $program_ids[] = $programs->ID;
    }
}
$section_heading = $settings['section_heading'];
$featured_content_selected_posts = $settings['selected_programs'];
$section_carousel_or_grid = $settings['section_carousel_or_grid'];


$query = [];

if ($featured_content_selected_posts || $program_ids) {
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'program',
        'post__in' => ($program_ids) ? $program_ids : $featured_content_selected_posts,
    );

    $query = new WP_Query($args);
}
$rand_id = rand(1, 1000);

if ($query->post_count > 0) {
    ?>
    <!--====== HTML CODING START ========-->

    <div class="ippi-related-programs toc-container">
        <div class="ippi-container">
            <h2 class="ippi-related-programs-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
        <div class="ippi-related-programs-wrapper ippi-container">
            <div class=" <?php echo ($section_carousel_or_grid == 'yes') ? 'ippi-related-programs-slider-'.$rand_id.' ippi-related-programs-slider slick-slider' : ''; ?>" slider-id="<?php echo $rand_id; ?>">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    $id = get_the_ID();
                    $image = get_the_post_thumbnail($post, 'full');
                    ?>
                    <div class="ippi-grid-col-1/2- ippi-related-programs-item">
                        <a href="<?php echo get_the_permalink() ?>">
                            <div class="ippi-related-programs-item-wrapper">
                                <div class="ippi-related-programs-item-image">
                                    <?php echo $image; ?>
                                    <p class="ippi-current-post-type"><?php _e('Program', 'ippi');?></p>
                                </div>
                                <div class="ippi-related-programs-item-content-area ">
                                    <div class="ippi-related-programs-item-heading">
                                        <h3 class="ippi-related-programs-item-title">
                                            <span class="ippi-related-programs-item-title-main"> <?php echo get_the_title(); ?> </span>
                                        </h3>
                                    </div>
                                    <div class="ippi-related-programs-item-description">
                                        <p><?php echo get_the_excerpt(); ?></p>
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
                <div class="ippi-related-program-slick-prev ippi-related-program-slick-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                <!-- <p><span class="current-slide-count">1</span> of <span class="all-slide-count"><?php echo $query->post_count ?></span></p> -->
                <div class="ippi-related-program-slick-next ippi-related-program-slick-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
            </div>
        </div>
    </div>
    <!--========== HTML CODING END============-->
    <style>
        
    </style>
    <?php

    wp_reset_postdata();
}
