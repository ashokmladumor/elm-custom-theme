<?php

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$top_content = (isset($settings['item_description'])) ? $settings['item_description'] : '';
$section_full_width = ($settings['section_full_width']) ? 'full-width' : '';
$section_background = $settings['section_full_width'];
$gravity_form_select = $settings['gravity_form_select'];
?>

<div class="ippi-form-wrapper <?php echo $section_full_width; ?>">
    <div class="form-title js-accordion-title">
        <h4><?php _e($section_heading, 'ippi'); ?></h4>
    </div>
    <div class="form-content">
        <div class="top_content">
            <?php _e($top_content, 'ippi'); ?>
        </div>
        <?php
            if( $gravity_form_select ){ 
                echo do_shortcode('[gravityform id="'.$gravity_form_select.'" title="false" description="false" ajax="true"]');
            }
        ?>
    </div>   
</div>


