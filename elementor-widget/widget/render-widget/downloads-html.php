<?php

//$section_heading = $settings['section_heading'];
$downloads = get_field('downloads');
?>
<!--====== HTML CODING START ========-->
<div class="ippi-downloads-wrapper">
    <?php if( !empty( $downloads ) ):
        foreach ( $downloads as $download ) : ?>
            <div class="ippi-downloads">
                <a class="download-item" href="<?php echo $download[ 'download_url' ]; ?>" target="_blank">
                    <?php _e($download[ 'download_text' ], 'ippi'); ?>
                    <i class="ipp-icon-<?php echo $download[ 'icon' ]; ?>" aria-hidden="true"></i>
                </a>
            </div>
        <?php 
        endforeach;
    endif; ?>     
</div>

  