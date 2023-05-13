<?php

//echo '<pre>';
//print_r($settings);
//echo '</pre>';

$section_heading = $settings['section_heading'];
$section_carousel_or_grid = $settings['section_carousel_or_grid'];
$get_related_content_ids = get_field( 'related_content', get_the_ID() );

$related_content = new WP_Query(array(
    'post_type' => array('podcast', 'video'),
    'post_status' => 'publish',
    'post__in'     => $get_related_content_ids,
));

$rand_id = rand(1, 1000);
if ($related_content->post_count) {
?>
    <!--====== HTML CODING START ========-->


    <div class="ippi-related-content">
        <div class="ippi-container">
            <h2 class="ippi-related-content-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
        <div class="ippi-related-content-wrapper ippi-container">
            <div class=" <?php echo ($section_carousel_or_grid == 'yes') ? 'ippi-slider-3 ippi-related-content-slider-'.$rand_id.' ippi-related-content-slider slick-slider' : ''; ?>" slider-id="<?php echo $rand_id; ?>">
                <?php
                while ($related_content->have_posts()) : $related_content->the_post();
                    $post = get_post();
                    $id = get_the_ID();
                    $image = get_the_post_thumbnail($post, 'full');
                    $post_type = '';
                    $icon = '';
                    if ( get_post_type( get_the_ID() ) == 'video' ) {
                        $post_type = __('Video','ippi-elementor-child');
                        $icon = 'icon-video';
                    }elseif( get_post_type( get_the_ID() ) == 'podcast' ){
                        $post_type = __('Podcast','ippi-elementor-child');
                        $icon = 'icon-podcast';
                    }
                    
                ?>
                    <div class="ippi-grid-col-1/2- ippi-related-content-item">
                        <a href="<?php the_permalink() ?>">
                            <div class="ippi-related-content-item-wrapper">
                                <div class="ippi-related-content-item-image">
                                    <?php 
                                    if($image) :
                                        echo $image;
                                    else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/f-6.png"alt="video">
                                    <?php
                                    endif;
                                    echo "<div class='icon ".$icon."'></div>";                                   
                                    ?>
                                </div>
                                <div class="ippi-related-content-item-content-area ">
                                    <div class="ippi-related-content-item-heading">
                                        <h3 class="ippi-related-content-item-title">
                                            <span class="ippi-related-content-item-content-type"><?php _e($post_type, 'ippi'); ?> <?php _e('|', 'ippi');?></span>
                                            <span class="ippi-related-content-item-title-main"> <?php the_title(); ?> </span>
                                        </h3>
                                    </div>
                                    <div class="ippi-related-content-item-description">
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                    <div class="ippi-related-content-item-details">
                                        <span class="ippi-related-content-item-date"> <?php echo get_the_date(); ?></span>
                                        <span class="ippi-related-content-item-view-count"> <?php echo get_field('reading_time'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                endwhile;
                ?>
            </div>
            <div class="custom_paging ippi-slider-arrow-3-paging">
                <div class="ippi-related-content-slick-prev ippi-slider-arrow-3 ippi-slider-3-prev ippi-related-content-slick-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                <!-- <p><span class="current-slide-count">1</span> of <span class="all-slide-count"><?php echo $query->post_count ?></span></p> -->
                <div class="ippi-related-content-slick-next ippi-slider-arrow-3 ippi-slider-3-next ippi-related-content-slick-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
            </div>
        </div>
    </div>
    <!--========== HTML CODING END============-->
    <style>
        
    </style>
    <script>
        jQuery(document).ready(function() {

            //add show more text
            jQuery(`<a href="#" class="show-more"> Show More </a>`).insertAfter(".overview-text");
            jQuery(".show-more").click(function (e) {
                e.preventDefault();
                if(jQuery(".overview-text").hasClass("show-more-height")) {
                    jQuery(this).text(" Show Less ").addClass('active');
                } else {
                    jQuery(this).text(" Show More").removeClass('active');
                }

                jQuery(".overview-text").toggleClass("show-more-height");
            });
            //end show more

        });
    </script>

<?php

    wp_reset_postdata();
}
