<?php

$enable_filters = $settings['enable_filters'];
$job_fellowhips_categories_ids = $settings['job_fellowhips_categories_ids'];
$job_fellowhips_tag_ids = $settings['job_fellowhips_tag_ids'];

?>
<!--====== HTML CODING START ========-->
<div class="ippi-experts-carousel">
    <?php if ($enable_filters == 'yes') { ?>
        <!-- <header class="tabs-nav"> -->
        <ul class="tabs-nav">
            <li class="active"><a href="#all"><?php _e('All', 'ippi'); ?></a></li>
            <li><a href="#jobs"><?php _e('Jobs', 'ippi'); ?></a></li>
            <li><a href="#fellowships"><?php _e('Fellowships', 'ippi'); ?></a></li>
        </ul>
        <!-- </header> -->
    <?php } ?>
    <?php
    $args = array(
        // 'numberposts' => -1,
        'post_type' => 'job_and_fellowship',
        'suppress_filters' => false,
    );

    // if( !empty ( $job_fellowhips_categories_ids ) ){
    //     // $terms = [];                        
    //     foreach ($job_fellowhips_categories_ids as $term_id) {
    //         $term = get_term($term_id);
    //         $term_array[$term->taxonomy][] = $term_id;
    //         $args['tax_query'][$term->taxonomy] = array(
    //             'taxonomy' => $term->taxonomy,
    //             'field' => 'id',
    //             'terms' => $term_array[$term->taxonomy],
    //             'operator' => 'IN',
    //         );
    //     }                        
    // } 

    // echo "<pre>";
    // print_r($args);
    // echo "</pre>";

    $all_jobs = get_posts($args);
    ?>
    <!-- tab content -->
    <section class="tabs-content">
        <div id="all" class="main-tab">
            <?php
            if ($all_jobs) : ?>
                <!-- Start html -->
                <div id="accordion" class="accordion-container"><?php
                                                                foreach ($all_jobs as $job) :
                                                                    include(plugin_dir_path(__FILE__) . '/template-part/jobs-and-fellowships-loop-item.php');
                                                                endforeach;
                                                                ?>
                </div>
                <!-- End html -->
            <?php endif;
            wp_reset_postdata(); ?>
        </div>

        <!-- tab content jobs -->
        <div id="jobs" class="main-tab">
            <?php
            $args = array(
                'numberposts' => -1,
                'post_type' => 'job_and_fellowship',
                'suppress_filters' => false,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'type',
                        'field' => 'slug',
                        'terms' => array('full-time', 'part-time'),
                    )
                )
            );

            $only_jobs = get_posts($args);
            if ($only_jobs) : ?>
                <!-- Start html -->
                <div id="accordion" class="accordion-container"><?php
                                                                foreach ($only_jobs as $job) :
                                                                    include(plugin_dir_path(__FILE__) . '/template-part/jobs-and-fellowships-loop-item.php');
                                                                endforeach;
                                                                ?>
                </div>
                <!-- End html -->
            <?php endif;
            wp_reset_postdata(); ?>
        </div>

        <!-- tab content fellowships -->
        <div id="fellowships" class="main-tab">
            <?php

            $args = array(
                'numberposts' => -1,
                'post_type' => 'job_and_fellowship',
                'suppress_filters' => false,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'type',
                        'field' => 'slug',
                        'terms' => array('fellowship'),
                    )

                )
            );

            $only_fellowship = get_posts($args);
            if ($only_fellowship) : ?>
                <!-- Start html -->
                <div id="accordion" class="accordion-container"><?php
                                                                foreach ($only_fellowship as $job) :
                                                                    include(plugin_dir_path(__FILE__) . '/template-part/jobs-and-fellowships-loop-item.php');
                                                                endforeach;
                                                                ?>
                </div>
                <!-- End html -->
            <?php endif;
            wp_reset_postdata(); ?>
    </section>
</div>

<style>
    .tabs-nav ul {
        margin: 0;
        padding: 0;
        border-bottom: 2px solid #000;
    }

    .tabs-nav li {
        display: inline-block;
        color: #fefefe;
        border-width: 1px 1px 0 1px;
    }

    .tabs-nav a {
        display: block;
        padding: 10px 15px;
        font-weight: bold;
        color: #000;
    }

    /* Active tab */

    .tabs-nav li.active {
        background: #FFF;
        color: #000;
        border-bottom: 3px solid #FF1F8E;
    }

    .tabs-nav li.active a {
        color: inherit;
    }

    /* Tab content */

    .tabs-content {

        padding: 10px;
        background: #FFF;
        margin-top: -1px;
        overflow: hidden;
    }

    .tabs-content IMG {
        margin-right: 10px;
    }

    /* Hide all but first content div */

    .tabs-content .main-tab:not(:first-child) {
        display: none;
    }

    /* end tab */

    .accordion-container .accordion-title {
        position: relative;
        margin: 0;
        padding: 0.625em 0.625em 0.625em 2em;
        background-color: #F5F7F6;
        font-size: 1.25em;
        font-weight: normal;
        color: #000000;
        cursor: pointer;
    }

    /* .accordion-container .accordion-title:hover,
    .accordion-container .accordion-title:active,
    .accordion-title.open {
      background-color: #00aaa7;
    } */
    .accordion-container .accordion-title::after {
        content: "";
        position: absolute;
        top: 25px;
        right: 25px;
        width: 0;
        height: 0;
        border: 8px solid transparent;
        border-top-color: #000;
    }

    .accordion-container .accordion-title.open::after {
        content: "";
        position: absolute;
        top: 15px;
        border: 8px solid transparent;
        border-bottom-color: #000;
    }

    /*CSS for CodePen*/

    .accordion-content {
        padding-left: 2.3125em;
        border: 1px solid #0079c1;
    }

    .accordion-container {
        width: 100%;
        margin: 0 auto;
    }
</style>
<!--========== HTML CODING END============-->

<script>
    jQuery(function() {
        jQuery('.tabs-nav a').click(function() {

            // Check for active
            jQuery('.tabs-nav li').removeClass('active');
            jQuery(this).parent().addClass('active');

            // Display active tab
            let currentTab = jQuery(this).attr('href');
            jQuery('.tabs-content .main-tab').hide();
            jQuery(currentTab).fadeIn();

            return false;
        });

        //accordian
        jQuery(".accordion-content:not(:first-of-type)").css("display", "none");
        jQuery(".js-accordion-title:first-of-type").addClass("open");
        jQuery(".js-accordion-title").click(function() {
            jQuery(".open").not(this).removeClass("open").next().slideUp(300);
            jQuery(this).toggleClass("open").next().slideToggle(300);
        });
    });
</script>