<?php

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$list = (isset($settings['list'])) ? $settings['list'] : '';
$pdf_title = (isset($settings['pdf_title'])) ? $settings['pdf_title'] : '';
$link = (isset($settings['link'])) ? $settings['link'] : '';
?>

<div class="ippi-agenda">
    <div class="accordion-title-agenda js-accordion-title-agenda">
        <h4><?php _e($section_heading, 'ippi'); ?></h4>
    </div>
    <div class="accordion-content-agenda">
        <?php if (isset($settings['list'])) {
            foreach ($settings['list'] as $item) {
                $hour_start = $item['hour_start'];
                $hour_end = $item['hour_end'];
                $list_content = $item['list_content'];
                $list_title = $item['list_title'];
                $read_more_toggle = $item['read_more_toggle'];
                $content = $item['list_content'];
        ?>
                <div class="ippi-agenda-wrapper middle">
                    <div class="ippi-hours-section ippi-grid-row">
                        <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> ippi-grid-col-1/5">
                            <p class="ippi-start-end-hours"><?php _e($item['hour_start'] . ' - ' . $item['hour_end'], 'ippi') ?></p>
                        </div>
                        <div class="ippi-agenda-content ippi-grid-col-4/5">
                            <div class="ippi-title">
                                <h3><?php _e($item['list_title'], 'ippi'); ?></h3>
                            </div>
                            <?php $word_count = str_word_count($content);
                            if ($word_count >= 30) { ?>
                                <div class="event-time-list active"><?php _e($content, 'ippi'); ?></div>
                                <p class="rdmore"><?php _e('More','ippi');?>
                                <i class="more-icon fas fa-angle-down"></i> </p>
                            <?php   } else { ?>
                                <div class="event-time-list active"><?php _e($content, 'ippi'); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
        <div class="ippi-link-title ippi-hours-section">
            <?php if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('link', $settings['link']);
            } ?>
            <a class="ippi-dwn-link-tag" href="<?php echo $link['url']; ?>" <?php echo ($link['is_external']) ? 'target="_blank"' : '' ?>>

                <div class="ippi-agenda-download-icon" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/download-icon.svg' ?>)"> <span class="ippi-download-pdf-title"> <?php _e($pdf_title, 'ippi'); ?></span></div>
            </a>
        </div>


    </div>
</div>
<style>
    .ippi-agenda-download-icon {
        background-repeat: no-repeat;
        background-size: 24px;
        background-position: right center;
        width: 100%;
    }
</style>
<script>
    jQuery(".accordion-content-agenda:not(:first-of-type)").css("display", "none");
    jQuery(".js-accordion-title-agenda").click(function() {
        // jQuery(".opened").not(this).removeClass("opened").next().slideUp(300);
        // jQuery(this).toggleClass("opened").next().slideToggle(300);
        if (jQuery(this).hasClass('.opened')) {
            jQuery(this).removeClass("opened").next().slideUp(300);
        } else {
            jQuery(this).addClass("opened").next().slideToggle(300);
        }
    });

    jQuery('.rdmore').click(function(e) {
        e.preventDefault();
        jQuery(this).parents('.ippi-agenda-content').find('.event-time-list').toggleClass('active');
        jQuery(this).toggleClass('active');
        if (jQuery(this).hasClass('active')) {
            jQuery(this).html('Less <i class="more-icon fas fa-angle-up"></i>')
        } else {
            jQuery(this).html('More <i class="more-icon fas fa-angle-down"></i>');
        }
    });
</script>