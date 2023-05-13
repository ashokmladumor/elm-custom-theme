<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$section_content = (isset($settings['section_content'])) ? $settings['section_content'] : '';
$image_and_content_type = (isset($settings['content_type'])) ? $settings['content_type'] : '';
$share_icon = (isset($settings['share_icon'])) ? $settings['share_icon'] : 'no';
$date_reading = (isset($settings['date_reading'])) ? $settings['date_reading'] : 'no';
$post_full_banner = (isset($settings['post_full_banner'])) ? $settings['post_full_banner'] : 'no';
$image_credit_remove = (isset($settings['image_credit_remove'])) ? $settings['image_credit_remove'] : 'no';
$show_post_type_tax = (isset($settings['show_post_type_tax'])) ? $settings['show_post_type_tax'] : 'no';



$section_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$image_credit = (isset($settings['image_credit'])) ? $settings['image_credit'] : '';
$image_credit_link = (isset($settings['image_credit_link'])) ? $settings['image_credit_link'] : '';
if (isset($image_credit_link['url'])) {
    $image_credit_link = $image_credit_link['url'];
}
$get_creditor_link = get_field('image_creditor_link');
if ($get_creditor_link) {
    $image_credit_link = $get_creditor_link;
}

$image_description = (isset($settings['image_description'])) ? $settings['image_description'] : '';
$image_popup_description = (isset($settings['image_popup_description'])) ? $settings['image_popup_description'] : '';
$get_types = get_the_terms(get_the_ID(), 'publication-type');

$reading_time = get_post_meta(get_the_ID(), 'reading_time', true);
?>

<section class="section-full-banner-content ippi-image-with-content">
    <div class="full-banner-inner">
    <?php if($post_full_banner == 'yes') {?>
        <?php if ($section_image) { ?>
            <img src="<?php _e($section_image, 'ippi'); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
        <?php } ?>
        <?php } ?>
        <div class="ippi-container">
            <div class="full-banner-content-wrapper ippi-banner-style-<?php echo $image_and_content_type; ?>">
                <?php
                if ($image_and_content_type == 'program') {
                    $post_type_name = get_post_type();
                ?>
                    <ul class="sub-label-program">
                        <li>
                            <?php echo $post_type_name; ?>
                        </li>
                    </ul>
                <?php
                } ?>
                <h1><?php the_title(); ?></h1>
                <div class="full-banner-content">
                    <?php _e($section_content, 'ippi'); ?>
                </div>
                <ul>
                    <?php
                    $postType = get_post_type();
                    
                    // print_r($postType);
                    if ($postType == 'backgrounder') { ?>
                        <li> 
                            <?php echo $postType; ?> 
                        </li>
                    <?php } ?>
                    <?php if ($image_and_content_type == 'default') {
                        if (!empty($get_types)) {
                            $types = [];
                            foreach ($get_types as $type) {
                                $types[] = $type->name;
                            } ?>
                            <li>
                                <?php echo implode(',', $types); ?>
                            </li>
                        <?php } ?>
                        <li>
                            <?php echo get_the_date('j F Y'); ?>
                        </li>
                        <?php if ($reading_time) { ?>
                            <li>
                                <?php _e($reading_time, 'ippi'); ?>
                            </li>
                        <?php }
                    } else if ($image_and_content_type == 'dossier') {
                        $post_type_name = get_post_type();
                        ?>
                        <li>
                        <?php if($show_post_type_tax == 'yes') {?>
                            <?php echo $post_type_name; ?>
                        <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
                
                
                    <div class="ippi-featured-content-item-details ippi-banner-style-<?php echo $image_and_content_type; ?>">
                    <ul class="sub-label-program">
                        <li>
                            <?php echo $post_type_name; ?>
                        </li>
                        <?php if($date_reading == 'yes') {?>
                            <span class="ippi-featured-content-item-date"> <?php echo get_the_date(); ?></span>
                            <span class="ippi-featured-content-item-view-count"> <?php _e(get_field('reading_time'), 'ippi'); ?></span>
                            <?php } ?>
                    </div>
                
                
                <?php if($share_icon == 'yes') {?>
                    <div class="ippi-post-share-icon ippi-banner-style-<?php echo $image_and_content_type; ?>">
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
        </div>
        <?php if ($image_and_content_type != 'program') { ?>
            <div class="ippi-container">
                <div class="ippi-banner-image-credit-content">
                    <p class="ippi-text-right">
                    <?php if($image_credit_remove == 'yes') {?>
                        <span class="ippi-text-white"><?php _e('Image credit:', 'ippi'); ?>
                            <?php if($image_credit_link && $image_credit_link != '#'){ ?>
                            <a class="ippi-text-white ippi-text-underline ippi-open-image-credit-popup" href="#ippi-image-credit-popup" image-credit="<?php echo $image_credit; ?>" image-link="<?php echo $image_credit_link; ?>" image-description="<?php echo $image_popup_description; ?>"><?php _e($image_credit, 'ippi'); ?></a>
                            <?php }else{ ?>
                                <a class="ippi-text-white ippi-text-underline ippi-open-image-credit-popup" href="javascript:void(0)" image-credit="<?php echo $image_credit; ?>" image-link="<?php echo $image_credit_link; ?>" image-description="<?php echo $image_popup_description; ?>"><?php _e($image_credit, 'ippi'); ?></a>
                            <?php }  ?>
                        </span>
                        <?php } ?>
                    </p>
                    <?php if ($image_description) { ?>
                        <div class="banner-credit-content">
                            <?php _e($image_description, 'ippi'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if ($image_and_content_type == 'program') { ?>
        <div class="ippi-container">
            <div class="ippi-banner-image-credit-content ippi-popup-style-<?php echo $image_and_content_type; ?>"">
                    <p class=" ippi-text-right">
                <span class="ippi-text-white"><?php _e('Image credit:', 'ippi'); ?>
                    <a class="ippi-text-white ippi-text-underline ippi-open-image-credit-popup" href="#ippi-image-credit-popup" image-credit="<?php echo $image_credit; ?>" image-link="<?php echo $image_credit_link; ?>" image-description="<?php echo $image_popup_description; ?>"><?php _e($image_credit, 'ippi'); ?></a>
                </span>
                </p>
                <?php if ($image_description) { ?>
                    <div class="banner-credit-content">
                        <?php _e($image_description, 'ippi'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</section>
<style>
    [dir='rtl'] .rtl .full-banner-content-wrapper.ippi-banner-style-program h1 {
        text-align: center;
    }
</style>
<script>
    jQuery(document).ready(function() {
        jQuery('.ippi-open-image-credit-popup').click(function() {
            var image_credit = 'Image Credit: ' + jQuery(this).attr('image-credit');
            var image_link = jQuery(this).attr('image-link');
            var image_description = jQuery(this).attr('image-description');
            var popup_elm = jQuery(this).attr('href')
            jQuery(popup_elm).addClass('active');
            jQuery(popup_elm).find('.ippi-credit-popup-title').html(image_credit);
            jQuery(popup_elm).find('.ippi-credit-popup-description').html(image_description);
            jQuery(popup_elm).find('.ippi-credit-popup-link').attr('href', image_link);
        });
    });
</script>