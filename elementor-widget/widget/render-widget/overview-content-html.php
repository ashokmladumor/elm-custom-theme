<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$content = (isset($settings['overview_content'])) ? $settings['overview_content'] : [];
$word_count = (isset($settings['word_count'])) ? $settings['word_count'] : '';
$show_btn = (isset($settings['enable_show_more_btn'])) ? $settings['enable_show_more_btn'] : 'yes';
$short_content = get_short_html($content, $word_count, '...');
$count_word = str_word_count($content);
// var_dump($word_count);
// print_r($count_word);
// var_dump($short_content);

?>
<div class="ippi-overview-content-wrapper">
    <div class="ippi-overview-content-inner">
        <?php if ($section_heading) { ?>
            <h2><?php _e($section_heading, 'ippi'); ?></h2>
        <?php } ?>
        <div class="ippi-overview-content">
            <?php if ($content) {
            ?>
                <?php if ($word_count) { ?>
                    <div class="short-content"><?php _e($short_content, 'ippi'); ?></div>
                <?php } ?>
                <div class="full-content" <?php echo ($word_count) ? 'style="display:none;"' : ''; ?>><?php _e($content, 'ippi'); ?></div><?php
                                                                                                                                } ?>
            <?php if ($content != '' && $show_btn == 'yes' && $word_count < $count_word  ) { ?>
                <span class="show-more-btn"><?php _e('Show More','ippi');?> <i class="more-icon fas fa-angle-down"></i></span>
            <?php } ?>

        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {

        jQuery('.show-more-btn').click(function() {
            var parent = jQuery(this).parents('.ippi-overview-content');
            parent.find('.short-content').toggle();
            parent.find('.full-content').toggle();
            jQuery(this).toggleClass('active');
            if (jQuery(this).hasClass('active')) {
                jQuery(this).html('<span class="less-class">Less</span> <i class="more-icon fas fa-angle-up"></i>')
            } else {
                jQuery(this).html('More <i class="more-icon fas fa-angle-down"></i>');
            }
            console.log(parent);
        });
    });
</script>

<?php
