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
        <div class="ippi-section-explainer-post-section">
            <div class="ippi-explainer-post-section-wrapper">
                <div class="ippi-explainer-post-section-container">
                    <div class="ippi-grid-row ippi-explainer-post-section-row">
                        <div class="ippi-grid-col-45">
                            <div class="ippi-explainer-post-section-content">
                                <div class="ippi-explainer-post-section-term-data">
                                    <div class="ippi-explainer-post-section-heading">
                                        <h1 class="ippi-explainer-post-section-title"><?php _e($term_name,'ippi'); ?></h1>
                                    </div>
                                    <div class="ippi-explainer-post-section-desc">
                                        <p class="ippi-explainer-post-section-description"><?php _e($description, 'ippi'); ?></p>
                                    </div>
                                    <div class="ippi-featured-content-item-details">
                                        <span class="ippi-featured-content-item-date"> <?php echo get_the_date(); ?></span>
                                        <span class="ippi-featured-content-item-view-count"> <?php _e(get_field('reading_time'), 'ippi'); ?></span>
                                    </div>
                                    <div class="ippi-share-icon">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
                                                <div data-network="facebook" class="fab fa-facebook-f st-custom-button"></div>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>" target="_blank">
                                                <div data-network="twitter" class="fab fa-twitter st-custom-button"></div>
                                            </a>
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>&title=<?php echo $title; ?>" target="_blank">
                                                <div data-network="linkedin" class="fab fa-linkedin-in st-custom-button"></div>
                                            </a>
                                            <a href="<?php echo $email; ?>" target="_blank">
                                                <div data-network="email" class="fas fa-envelope st-custom-button"></div>
                                            </a>
                                            <a href="#" class="print_current_page">
                                                <div data-network="print" class="fas fa-print st-custom-button"></div>
                                        </a>
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