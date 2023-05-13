<?php

//$section_heading = $settings['section_heading'];
if(is_tax()) {
    $current_term = get_queried_object();
    $hero_title = $current_term->name;
    $term_id = $current_term->term_id;
    $description = $current_term->description;
    $image = (get_field('featured_image',  $current_term)) ? get_field('featured_image',  $current_term) : get_stylesheet_directory_uri(). '/assets/images/no-image.png';
    $taxonomy = get_taxonomy( $current_term->taxonomy );
    $hero_sub_title =  $taxonomy->label;
} else {

    // echo '<pre>';
    // print_r(get_post(get_the_ID()));
    // echo '</pre>';

    
    $hero_sub_title = get_post_type();// post type name;
    $description = get_the_excerpt();// post desc;
    $image = get_the_post_thumbnail_url();// post image ni URL
    $hero_title =  get_the_title();// post nu title
}

$share_icon = (isset($settings['share_icon'])) ? $settings['share_icon'] : 'no';
$date_reading = (isset($settings['date_reading'])) ? $settings['date_reading'] : 'no';
$show_post_type_tax = (isset($settings['show_post_type_tax'])) ? $settings['show_post_type_tax'] : 'no';

    ?>
        <!--====== HTML CODING START ========-->
        <div class="ippi-section-category-hero">
            <div class="ippi-cat-hero-wrapper">
                <div class="ippi-cat-hero-container">
                    <div class="ippi-grid-row ippi-cat-hero-row">
                        <div class="ippi-grid-col-45">
                            <div class="ippi-cat-hero-content">
                                <?php if($show_post_type_tax == 'yes') {?>
                                    <div class="ippi-cat-hero-taxonomy">
                                        <p class="ippi-cat-hero-tax-title"><?php _e($hero_sub_title,'ippi'); ?></p>
                                    </div>
                                <?php } ?>
                                <div class="ippi-cat-hero-term-data">
                                    <div class="ippi-cat-hero-term-heading">
                                        <h1 class="ippi-cat-hero-term-title ippi-explainer-term-title"><?php _e($hero_title,'ippi'); ?></h1>
                                    </div>
                                    <div class="ippi-cat-hero-term-desc">
                                        <p class="ippi-cat-hero-term-description"><?php _e($description, 'ippi'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if($date_reading == 'yes') {?>
                                <div class="ippi-featured-content-item-details">
                                        <span class="ippi-cat-hero-tax-title"><?php _e($hero_sub_title,'ippi'); ?></span>
                                        <span class="ippi-featured-content-item-date"> <?php echo get_the_date(); ?></span>
                                        <span class="ippi-featured-content-item-view-count"> <?php _e(get_field('reading_time'), 'ippi'); ?></span>
                                </div>
                            <?php } ?>
                                <?php if($share_icon == 'yes') {?>
                                    <div class="ippi-post-share-icon">
                                        <label for="ippi-post-share-icon-label">
                                        <div class="ippi-share-icon" id="">
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
                                        </label>
                                    </div>
                                <?php } ?>
                        </div>
                        <div class="ippi-grid-col-55">
                        <div class="ippi-cat-hero-image">
                                <div class="ippi-cat-hero-image-container" style="background-image: url(<?php _e($image,'ippi'); ?>)">
                                    <!--<img title="<?php /*echo $hero_sub_title; */?>" alt="<?php /*echo $hero_sub_title; */?>" src="">-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php 


// function sanitizeStringForUrl($string){
//     $string = strtolower($string);
//     $string = html_entity_decode($string);
//     $string = str_replace(array('ä','ü','ö','ß'),array('ae','ue','oe','ss'),$string);
//     $string = preg_replace('#[^\w\säüöß]#',null,$string);
//     $string = preg_replace('#[\s]{2,}#',' ',$string);
//     $string = str_replace(array(' '),array('-'),$string);
//     return $string;
// }
  