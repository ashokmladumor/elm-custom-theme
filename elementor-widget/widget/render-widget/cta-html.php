<?php
$title = (isset($settings['title'])) ? $settings['title'] : '';
$content = (isset($settings['content'])) ? $settings['content'] : '';
$button_title = (isset($settings['button_title'])) ? $settings['button_title'] : '';
$button_link = (isset($settings['button_link'])) ? $settings['button_link'] : '';
$position_layout =(isset($settings['position_layout'])) ? $settings['position_layout'] : '';
$layout =(isset($settings['layout'])) ? $settings['layout'] : '';
$bg_color =(isset($settings['bg_color'])) ? $settings['bg_color'] : '';
print_r($bg_color);
$bg_image =(isset($settings['bg_image'])) ? $settings['bg_image'] : '';

// $grid_class = '';
// if ($position_layout == 'full_width' || $position_layout == 'left' || $position_layout == 'right') {
//     $grid_class = ' ippi-grid-row ';
// }
// if ($layout == 'color' || $layout == 'background_image') {
   
// }





?>
<div class="ippi-cta-main-section">
    <div class="ippi-conitainer">
        <div class="ippi-image-text-section">
        <?php if($bg_image) { ?>
            <img src="<?php echo $bg_image['url'];?>" /> 
        <?php  } ?>
            <div class="ippi-cta-title"><?php echo $title;?></div>
            <div class="ippi-cta-content"><?php echo $content;?></div>
            <div class="ippi-cta-button_title">
            <?php if (!empty($settings['button_link']['url'])) {
                $this->add_link_attributes('button_link', $settings['button_link']);
            } ?>
            <a class="ippi-dwn-link-tag" href="<?php echo $button_link['url']; ?>" <?php echo ($button_link['is_external']) ? 'target="_blank"' : '' ?>>
                <span class="ippi-download-pdf-title"> <?php echo $button_title; ?></span>
            </a>
            
        </div>
    </div>
</div>