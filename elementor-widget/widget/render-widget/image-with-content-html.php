<?php

$section_heading = $settings['section_heading'];
$section_content = $settings['section_content'];
$image_and_content_type = $settings['image_and_content_type'];
$section_image = $settings['section_image']['url'];
$image_credit = $settings['image_credit'];
$image_credit_link = $settings['image_credit_link'];
$image_description = $settings['image_description'];
$image_popup_description = $settings['image_popup_description'];

$grid_class = '';

if ($image_and_content_type == 'left_side_image' || $image_and_content_type == 'right_side_image' || $image_and_content_type == 'stretched_with_text') {
    $grid_class = ' ippi-grid-row ';
}

//if($image_and_content_type == 'stretched_with_text');

$first_col_class = ($image_and_content_type == 'left_side_image') ? 'ippi-image-wrapper' : (($image_and_content_type == 'right_side_image' || $image_and_content_type == 'full_width' || $image_and_content_type == 'stretched') ? 'ippi-content-wrapper' : '');

$image_stretched = ($image_and_content_type == 'stretched') ? ' ippi-image-stretched' : '';

?>

<section class="section-image-with-content ippi-image-with-content">
    <div class="<?php echo ($image_and_content_type == 'stretched_with_text') ? ' ippi-image-content-stretched' : '' ?>"
         style="<?php echo ($image_and_content_type == 'stretched_with_text') ? 'background-image: url(' . $section_image . ';' : ''; ?>">
        <div class="ippi-image-with-content-container ">
            <div class="ippi-image-with-content-wrapper ?>">
                <div class="<?php echo $grid_class; ?>">
                    <div class="<?php echo ($grid_class || $image_and_content_type == 'stretched_with_text') ? ' ippi-grid-col-1/2 ' : ''; ?>">
                        <div class="<?php echo $first_col_class;
                        echo ($image_stretched) ? ' ippi-container' : '' ?>">
                            <?php
                            if ($first_col_class == 'ippi-image-wrapper') {
                                ?>
                                <img src="<?php echo $section_image; ?>" alt="<?php _e($section_heading, 'ippi'); ?>">
                                <div class="ippi-image-credit-content <?php echo ($image_stretched) ? ' ippi-container' : '' ?>">
                                    <p class="ippi-text-gray">
                                        <span class="ippi-text-black"><?php _e('Image credit:', 'ippi');?>
                                            <a class="ippi-text-black ippi-text-underline ippi-open-image-credit-popup"
                                               href="#ippi-image-credit-popup" image-credit="<?php _e($image_credit, 'ippi'); ?>" image-link="<?php echo $image_credit_link; ?>" image-description="<?php _e($image_popup_description, 'ippi'); ?>"><?php _e($image_credit, 'ippi'); ?></a>
                                        </span>
                                        <?php _e($image_description, 'ippi'); ?>
                                    </p>
                                </div>
                                <?php
                            } else if ($first_col_class == 'ippi-content-wrapper') {
                                ?>
                                <?php if($section_heading) { ?>
                                    <h2 class="ippi-image-with-content-heading"><?php _e($section_heading, 'ippi'); ?></h2>
                                <?php }
                                    if($section_content) { ?>
                                    <div class="ippi-image-with-content-description"><?php _e($section_content, 'ippi'); ?></div>
                                <?php } ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="<?php echo ($grid_class || $image_and_content_type == 'stretched_with_text') ? ' ippi-grid-col-1/2 ' : ''; ?>">
                        <div class="<?php echo ($first_col_class == 'ippi-image-wrapper' || $image_and_content_type == 'stretched_with_text') ? 'ippi-content-wrapper' : (($first_col_class == 'ippi-content-wrapper') ? 'ippi-image-wrapper' : '');
                        echo $image_stretched; ?>">
                            <?php
                            if ($first_col_class == 'ippi-image-wrapper' || $image_and_content_type == 'stretched_with_text') {
                                ?>
                                <?php if($section_heading) { ?>
                                    <h2 class="ippi-image-with-content-heading"><?php _e($section_heading, 'ippi'); ?></h2>
                                <?php }
                                    if($section_content) { ?>
                                    <div class="ippi-image-with-content-description"><?php _e($section_content, 'ippi'); ?></div>
                                <?php } ?>
                                <?php
                            } else if ($first_col_class == 'ippi-content-wrapper') {
                                ?>
                                <img src="<?php echo $section_image; ?>" alt="<?php _e($section_heading, 'ippi'); ?>">

                                <div class="ippi-image-credit-content <?php echo ($image_stretched) ? ' ippi-container' : '' ?>">
                                    <p class="ippi-text-gray">
                                        <span class="ippi-text-black"><?php _e('Image credit:', 'ippi');?>
                                            <a class="ippi-text-black ippi-text-underline ippi-open-image-credit-popup"
                                               href="#ippi-image-credit-popup" image-credit="<?php _e($image_credit, 'ippi'); ?>" image-link="<?php echo $image_credit_link; ?>" image-description="<?php _e($image_popup_description, 'ippi'); ?>"><?php _e($image_credit, 'ippi'); ?></a>
                                        </span>
                                        <?php _e($image_description, 'ippi'); ?>
                                    </p>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($image_and_content_type == 'stretched_with_text') { ?>
        <div class="ippi-image-credit-content ippi-container">
            <p class="ippi-text-right ippi-text-gray">
                <span class="ippi-text-black"><?php _e('Image credit:', 'ippi');?>
                    <a class="ippi-text-black ippi-text-underline ippi-open-image-credit-popup"
                       href="#ippi-image-credit-popup" image-credit="<?php _e($image_credit, 'ippi'); ?>" image-link="<?php echo $image_credit_link; ?>" image-description="<?php _e($image_popup_description, 'ippi'); ?>"><?php _e($image_credit, 'ippi'); ?></a>
                </span>
                <?php _e($image_description, 'ippi'); ?>
            </p>
        </div>
    <?php } ?>
</section>

<style>
    .ippi-image-wrapper img {
        width: 100%;
        object-fit: cover;
        max-height: 850px;
    }

    .ippi-container {
        max-width: 1781px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .ippi-image-content-stretched {
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 800px;
        background-position: center;
        position: relative;
    }

    .ippi-image-content-stretched:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: transparent linear-gradient(90deg, #00000000 0%, #000000AF 42%, #000000 100%) 0% 0% no-repeat padding-box;
        z-index: 0;
    }

    .ippi-image-content-stretched .ippi-image-with-content-container, .ippi-image-content-stretched .ippi-image-with-content-container * {
        z-index: 1;
    }

    .ippi-image-content-stretched .ippi-content-wrapper * {
        color: #fff !important;
    }

    .ippi-image-content-stretched .ippi-grid-row {
        min-height: 800px;
        align-items: center;
    }
    .ippi-image-content-stretched {
        padding: 0 15px;
    }
    @media only screen and (max-width: 1024px) {
        .article-full-width-content .ippi-image-with-content-heading {
            font-size: 27px;
        }

        .article-full-width-content .ippi-image-with-content-description, .article-full-width-content .ippi-image-with-content-description p {
            font-size: 18px;
            line-height: 1.4em;
        }

        .article-content-area-wrapper .ippi-image-with-content-description {
            font-size: 18px;
            line-height: 1.4em;
        }
        .ippi-image-with-content .ippi-grid-col-1\/2 {
            padding-bottom: 0;
            padding-top: 0;
        }
    }
    @media only screen and (max-width: 768px) {
        .article-full-width-content .ippi-image-with-content-description, .article-full-width-content .ippi-image-with-content-description p, .article-content-area-wrapper .ippi-image-with-content-description {
            font-size: 16px;
        }

        .article-full-width-content .ippi-image-with-content-heading {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .ippi-image-content-stretched .ippi-grid-row {
            min-height: fit-content;
            padding-top: 150px;
        }
    }
</style>
<script>
    jQuery(document).ready(function () {
        jQuery('.ippi-open-image-credit-popup').click(function () {
            var image_credit ='Image Credit: ' + jQuery(this).attr('image-credit');
            var image_link = jQuery(this).attr('image-link');
            var image_description = jQuery(this).attr('image-description');
            var popup_elm = jQuery(this).attr('href')
            jQuery(popup_elm).addClass('active');
            jQuery(popup_elm).find('.ippi-credit-popup-title').html(image_credit);
            jQuery(popup_elm).find('.ippi-credit-popup-description').html(image_description);
            jQuery(popup_elm).find('.ippi-credit-popup-link').attr('href',image_link);
        });
    });
</script>