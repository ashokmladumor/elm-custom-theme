<?php

//echo '<pre>';
//print_r($settings);
//echo '</pre>';

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$selected_experts = $settings['selected_experts'];
$section_carousel_or_grid = $settings['section_carousel_or_grid'];

$query = [];

if ($selected_experts) {
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'experts',
        'post__in' => $selected_experts,
    );

    $query = new WP_Query($args);
}
$rand_id = rand(1, 1000);
if ($query->post_count > 0) {
?>
    <!--====== HTML CODING START ========-->
    <div class="ippi-expert">
        <div class="ippi-container">
            <h2 class="ippi-expert-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
        <div class="ippi-expert-wrapper ippi-container">
            <div class=" <?php echo ($section_carousel_or_grid == 'yes') ? 'ippi-expert-slider-' . $rand_id . ' ippi-expert-slider slick-slider' : ''; ?>" slider-id="<?php echo $rand_id; ?>">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    $id = get_the_ID();
                    $designation = get_post_meta($id, 'designation', true);

                    $term_obj_list = get_the_terms($id, 'expertise');
                    $expertise = join(', ', wp_list_pluck($term_obj_list, 'name'));

                    $dossiers = get_posts(array(
                        'numberposts'   => -1,
                        'post_type'     => 'dossier',
                        'meta_query' => array(
                            array(
                                'key' => 'related_experts',
                                'value' => '"' . get_the_ID() . '"',
                                'compare' => 'LIKE'
                            )
                        )
                    ));

                ?>
                    <div class="ippi-grid-col-1/2- ippi-expert-item">

                        <div class="ippi-expert-wrapper">
                            <div class="ippi-expert-item-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                            <div class="ippi-expert-item-content-area ">
                                <div class="ippi-expert-item-heading">
                                    <div class="expert-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </div>
                                    <?php if ($designation) : ?>
                                        <div class="ippi-expert-designation"> <?php _e($designation, 'ippi'); ?></div>
                                    <?php endif; ?>

                                    <div class="ippi-expert-categories"> <?php _e($expertise, 'ippi'); ?></div>
                                </div>
                                <div class="ippi-expert-excerpt">
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                                <?php if ($dossiers) :
                                    foreach ($dossiers as $dossier) :
                                        $dos_id = $dossier->ID; ?>
                                        <hr />
                                        <div class="ippi-dossier-item-details">
                                            <span class="dossier-lable"> <?php _e('Dossier', 'ippi-elementor-child'); ?> | </span>
                                            <span class="dossier-title"> <a href="<?php echo get_the_permalink($dos_id); ?>"><?php echo get_the_title($dos_id); ?> </a></span>
                                        </div>
                                <?php
                                    endforeach;
                                endif; ?>
                            </div>
                        </div>

                    </div>
                <?php
                endwhile;
                ?>
            </div>
            <div class="custom_paging">
                <div class="bfs-slick-prev" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                <div class="bfs-slick-next" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
            </div>
        </div>
    </div>
    <!--========== HTML CODING END============-->
    <script>
        var rtl = false;
        if (jQuery('body').hasClass('rtl')) {
            rtl = true;
        }
        jQuery(document).ready(function() {
            var slider_id = jQuery('.ippi-expert-slider').attr('slider-id');

            jQuery('.ippi-expert-slider').slick({
                    slidesToShow: 3,
                    // centerMode: true,
                    slidesToScroll: 3,
                    speed: 300,
                    infinite: true,
                    autoplay: true,
                    adaptiveHeight: true,
                    rtl: rtl,
                    nextArrow: jQuery('.bfs-slick-next'),
                    prevArrow: jQuery('.bfs-slick-prev'),
                    responsive: [{
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 1,
                                // slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]

                })
                .on('setPosition', function(event, slick) {
                    slick.jQuery(slides).css('height', slick.jQuery(slideTrack).height() + 'px');
                });;

            jQuery('.ippi-latest-content-slider').on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
                var i = (currentSlide ? currentSlide : 0) + 1;
                var slidesToShow = slick.slickGetOption('slidesToShow');
                var curPage = parseInt((i - 1) / slidesToShow) + 1;
                var lastPage = parseInt((slick.slideCount - 1) / slidesToShow) + 1;
                console.log(curPage, lastPage, '-=-=-=-=-=-');
                jQuery('.current-slide-count').text(curPage);
                jQuery('.all-slide-count').text(lastPage);
            });

        });
    </script>

<?php

    wp_reset_postdata();
}
