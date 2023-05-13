<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$section_description = (isset($settings['lead_left_content'])) ? $settings['lead_left_content'] : '';
$section_content = (isset($settings['lead_right_content'])) ? $settings['lead_right_content'] : '';
$content_leads_type = (isset($settings['content_leads_type'])) ? $settings['content_leads_type'] : '';
$author_name = (isset($settings['author_name'])) ? $settings['author_name'] : '';
$author_link = (isset($settings['author_link']['url'])) ? $settings['author_link']['url'] : '#';
$section_image = (isset($settings['section_image'])) ? $settings['section_image'] : '';

?>

<?php if($section_heading) { ?>
    <div class="ippi-content-leads-custom">
        <div class="ippi-container ippi-content-leads-heading">
            <h2><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
    </div>
<?php } ?>
<div class="ippi-content-leads-container">
    <div class="ippi-content-leads-wrapper <?php echo $section_heading_toggle ? ' -ippi-mt-70' : ''; ?>">
        <div class="ippi-grid-wrapper">
            <div class="ippi-grid-row ippi-content-lead-row">
                <div class="ippi-grid-col-1/2 ippi-content-leads-description">
                    <?php _e($section_description, 'ippi'); ?>
                </div>
                <div class="ippi-grid-col-1/2 ippi-content-leads-content">
                    <?php _e($section_content, 'ippi'); ?>
                    <p class="ippi-content-leads-author"><a href="<?php echo $author_link; ?>"><?php _e($author_name ,'ippi'); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$first_col_class = (($content_leads_type == 'full_width' || $content_leads_type == 'half_width') ? 'ippi-content-wrapper' : '');

$first_col_class = ($content_leads_type == 'left_side_description') ? 'ippi-image-wrapper' : (($content_leads_type == 'right_side_description' || $content_leads_type == 'full_width') ? 'ippi-content-wrapper' : '');

?>
<section class="section-content-leads ippi-content-leads">
    <div class="ippi-content-leads-container <?php echo ($content_leads_type == 'stretched_with_text') ? ' ippi-container' : '' ?>">
        <div class="ippi-content-leads-wrapper">
            <div class="<?php echo ($grid_class || $content_leads_type == 'stretched_with_text') ? ' ippi-grid-col-1/2 ' : ''; ?>">
                <div class="<?php echo $first_col_class;
                            echo ($content_stretched) ? ' ippi-container' : '' ?>">
                    <?php
                    if ($first_col_class == 'ippi-content-wrapper') {
                    ?>
                        <div class="ippi-content-leads-content"><?php _e($section_content, 'ippi'); ?></div>
                    <?php
                    } else if ($first_col_class == 'ippi-content-wrapper') {
                    ?>
                        <div class="ippi-content-leads-description"> <?php _e($section_description, 'ippi'); ?></div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="<?php echo ($grid_class || $content_leads_type == 'stretched_with_text') ? ' ippi-grid-col-1/2 ' : ''; ?>">
                <div class="<?php echo ($first_col_class == 'ippi-image-wrapper' || $content_leads_type == 'stretched_with_text') ? 'ippi-content-wrapper' : (($first_col_class == 'ippi-content-wrapper') ? 'ippi-image-wrapper' : '');
                            echo $image_stretched; ?>">
                    <?php
                    if ($first_col_class == 'ippi-content-wrapper') {
                    ?>
                        <div class="ippi-content-leads-description"> <?php _e($section_description, 'ippi'); ?></div>
                    <?php
                    } else if ($first_col_class == 'ippi-content-wrapper') {
                    ?>
                        <div class="ippi-content-leads-content"><?php _e($section_content, 'ippi'); ?></div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .ippi-content-leads-heading {
        font-size: 30px;
        line-height: 45px;
        font-family: default;
        font-weight: bold;
        color: #000;
    }
    .ippi-content-leads-description {
        font-family: "Noto Serif", Sans-serif;
        font-size: 24px;
        color: #000;
        line-height: 44px;
    }

    .ippi-content-leads-content, .ippi-content-leads-content p {
        font: normal normal normal 32px/50px Gibson;
        color: #000;
    }
    .ippi-content-leads-content .ippi-content-leads-author a, .ippi-content-leads-content .ippi-content-leads-author {
        font-family: "Helvetica";
        font-size: 18px;
        line-height: 22px;
        color: #000;
        text-decoration: underline;
    }

    @media only screen and (max-width: 960px) {
        .ippi-content-leads-description {
            font-size: 16px;
            line-height: 1.4;
        }

        .ippi-content-leads-content, .ippi-content-leads-content p {
            font-size: 16px;
            line-height: 1.4;
        }

        .ippi-content-leads-wrapper .ippi-grid-col-1\/2 {
            padding-top: 0;
            padding-bottom: 0;
        }

        .ippi-content-leads-content .ippi-content-leads-author a, .ippi-content-leads-content .ippi-content-leads-author {
            font-size: 16px;
        }
    }
</style>