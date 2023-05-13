<?php

//$section_heading = $settings['section_heading'];
if(is_tax()) {
    $current_term = get_queried_object();
    $term_name = $current_term->name;
    $term_id = $current_term->term_id;
    $description = $current_term->description;
    // $image = (get_field('featured_image',  $current_term)) ? get_field('featured_image',  $current_term) : get_stylesheet_directory_uri(). '/assets/images/no-image.png';
    $taxonomy = get_taxonomy( $current_term->taxonomy );
    $tax_title =  $taxonomy->label;

    ?>
        <!--====== HTML CODING START ========-->
        <div class="ippi-section-media-podcast">
            <div class="ippi-media-podcast-wrapper">
                <div class="ippi-media-podcast-container">
                    <div class="ippi-grid-row ippi-media-podcast-row">
                        <div class="ippi-grid-col-45">
                            <div class="ippi-media-podcast-content">
                                <div class="ippi-media-podcast-term-data">
                                    <div class="ippi-media-podcast-heading">
                                        <h1 class="ippi-media-podcast-title"><?php _e($term_name,'ippi'); ?></h1>
                                    </div>
                                    <div class="ippi-media-podcast-desc">
                                        <p class="ippi-media-podcast-description"><?php _e($description, 'ippi'); ?></p>
                                    </div>
                                    <div class="ippi-featured-content-item-details">
                                        <span class="ippi-featured-content-item-date"> <?php echo get_the_date(); ?></span>
                                        <span class="ippi-featured-content-item-view-count"> <?php _e(get_field('reading_time'), 'ippi'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php 
}