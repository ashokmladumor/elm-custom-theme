<div class="ippi-grid-col-1/2- ippi-recent-report-item">
    <a href="<?php echo get_the_permalink();?>">
        <div class="ippi-recent-report-item-wrapper">
            <div class="ippi-recent-report-item-image">
                <?php
                if ($image) :
                    echo $image;
                else : ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/f-6.png" alt="video">
                <?php
                endif;
                ?>
            </div>
            <div class="ippi-recent-report-item-content-area ">
                <div class="ippi-recent-report-item-heading">
                    <h3 class="ippi-recent-report-item-title">
                        <span class="ippi-recent-report-item-content-type"><?php _e($display_terms, 'ippi'); ?></span>
                        <span class="ippi-recent-report-item-title-main"> <?php the_title(); ?> </span>
                    </h3>
                </div>
                <div class="ippi-recent-report-item-description">
                    <p><?php the_excerpt(); ?></p>
                </div>
                <div class="ippi-recent-report-item-details">
                    <span class="ippi-recent-report-item-date"> <?php echo get_the_date(); ?></span>
                    <span class="ippi-recent-report-item-view-count"> <?php _e(get_field('reading_time'),'ippi'); ?></span>
                </div>
                <a class="elementor-button-link elementor-button elementor-size-sm" href="<?php echo get_the_permalink();?>"><?php _e('Read Report', 'ippi-elementor-child'); ?></a>
            </div>
        </div>
    </a>
</div>