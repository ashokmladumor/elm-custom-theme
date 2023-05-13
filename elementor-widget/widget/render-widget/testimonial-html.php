<?php

//echo '<pre>';
//print_r($settings);
//echo '</pre>';

$section_heading = $settings['testimonial_heading'];
$latest_testimonial_posts = $settings['latest_testimonial_posts'];

$query = [];

$args = array(
    'post_status' => 'publish',
    'post_type' => 'testimonials',
);

if ($latest_testimonial_posts) {
    $args['post__in'] = $latest_testimonial_posts;
} else {
    $args['posts_per_page'] = '5';
}

$query = new WP_Query($args);

$rand_id = rand(1, 1000);
if ($query->have_posts()) {
?>
    <!--====== HTML CODING START ========-->


    <div class="ippi-testimonial">
        <div class="ippi-container">
            <h2 class="ippi-testimonial-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
        <div class="ippi-testimonial-wrapper ippi-container">
            <div class="ippi-testimonial-slider ippi-testimonial-slider-<?php echo $rand_id; ?>" slider-id="<?php echo $rand_id; ?>">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    $id = get_the_ID();
                    $image = get_the_post_thumbnail_url($post, 'full');
                    if (!$image) {
                        $image = get_stylesheet_directory_uri() . '/assets/images/no-image.png';
                    }
                ?>
                    <div class="ippi-grid-col-1/2- ippi-testimonial-item">

                        <div class="ippi-testimonial-item-wrapper">
                            <div class="ippi-testimonial-item-image">
                                <img src="<?php echo $image; ?>">
                            </div>
                            <div class="ippi-testimonial-item-content-area ">
                                <div class="ippi-testimonial-item-heading">
                                    <h3 class="ippi-testimonial-item-title">
                                        <span class="ippi-testimonial-item-title-main"> <?php echo get_the_title(); ?> </span>
                                    </h3>
                                    <div class="ippi-testimonial-item-description">
                                        <p><?php echo get_the_excerpt(); ?></p>
                                    </div>
                                </div>

                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quote.png" alt="<?php the_title(); ?>" />


                                <div class="ippi-testimonial-item-details">
                                    <?php echo get_the_content(); ?>
                                    <p class="ippi-testimonial-item-read-more"><a href="<?php the_permalink(); ?>"><?php _e('Read Full Interview', 'ippi-elementor-child'); ?></a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
                endwhile;
                ?>
            </div>
            <div class="custom_paging">
                <div class="ippi-testimonial-slick-prev ippi-testimonial-slick-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                <!-- <p><span class="current-slide-count">1</span> of <span class="all-slide-count"><?php _e($query->post_count, 'ippi'); ?></span></p> -->
                <div class="ippi-testimonial-slick-next ippi-testimonial-slick-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
            </div>
        </div>
    </div>
    <!--========== HTML CODING END============-->
    <style>
        /* Related Content Carousal Start */

        .ippi-testimonial h2 {
            margin-bottom: 40px;
        }

        .ippi-testimonial-slider {
            z-index: 5;
        }

        .slick-slide {
            margin: 0 27px;
        }

        .slick-list {
            margin: 0 -27px;
        }

        .ippi-testimonial {
            display: block;
            padding-top: 120px;
            padding-bottom: 50px;
        }

        .ippi-testimonial .ippi-testimonial-item-content-area {
            background: #000000;
        }

        .ippi-testimonial-wrapper {
            position: relative;
        }

        .ippi-testimonial-item-wrapper {
            transition: all 0.3s ease-in-out 0s;
            background: #FFFFFF 0% 0% no-repeat padding-box;
        }

        h2.ippi-testimonial-section-title {
            margin: 0;
            padding: 0;
            font: normal normal 600 50px/60px Gibson;
            letter-spacing: 1px;
            color: #000000;
            margin-bottom: 50px;
        }

        h3.ippi-testimonial-item-title {
            font: normal normal 600 28px/20px Gibson;
            letter-spacing: 0.56px;
            color: #FFFFFF;
            margin-bottom: 9px;
            margin-top: 0;
        }

        .ippi-testimonial-item-wrapper:hover {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 3px 20px #00000029;
        }

        .ippi-testimonial-item-image {
            position: relative;
        }

        .icon {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 30px;
        }

        /* .ippi-testimonial-item-wrapper span.ippi-testimonial-item-title-main:hover {
            text-decoration: underline;
            text-decoration-color: #ff1f8e !important;
        } */

        span.ippi-testimonial-item-content-type {
            color: #FF1F8E;
            font-size: 30px;
            font-weight: 600;
            line-height: 42px;
            letter-spacing: 0.6px;
        }

        .ippi-testimonial-item-content-area:hover .ippi-testimonial-item-heading h3 {
            color: #ff1f8e;
        }

        .ippi-testimonial-item-content-area {
            padding: 35px 48px 40px 48px;
        }

        .slick-track {
            display: flex;
        }

        .slick-track .slick-slide {
            display: flex;
            height: auto;
        }

        .slick-slide img {
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .ippi-testimonial-item-wrapper {
            background: #F5F7F6 !important;
        }

        .ippi-testimonial-item-description {
            font: normal normal normal 18px/22px Helvetica Neue;
            letter-spacing: 0px;
            color: #9A9A9A;
        }

        .ippi-testimonial-item {
            margin-bottom: 10px;
        }

        .ippi-testimonial-item-wrapper {
            height: 100%;
        }


        .ippi-testimonial-item-details {
            font: normal normal normal 22px/34px Gibson;
            letter-spacing: 0.44px;
            color: #FFFFFF;
        }

        p.ippi-testimonial-item-read-more a {
            color: #FFFFFF;
        }

        p.ippi-testimonial-item-read-more {
            font: normal normal normal 20px/24px Helvetica Neue;
            letter-spacing: 0px;
            color: #FFFFFF;
            margin-top: 20px;
            margin-bottom: 0;
        }

        p.ippi-testimonial-item-read-more a:hover {
            text-decoration: underline #FF1F8E;
            -webkit-text-underline-position: under;
            -ms-text-underline-position: below;
            text-underline-position: under;
        }

        .ippi-testimonial-item-image img {
            height: auto;
            max-width: 100%;
            width: 100%;
            object-fit: cover;
            max-height: 316px;
        }

        span.ippi-testimonial-item-date {
            padding-right: 20px;
            position: relative;
        }

        span.ippi-testimonial-item-view-count {
            padding-left: 20px;
        }

        span.ippi-testimonial-item-date:after {
            content: '';
            height: 5px;
            width: 5px;
            background: #ff1f8e;
            position: absolute;
            right: -2px;
            top: 37%;
            bottom: 0;
            border-radius: 100px;
        }


        .ippi-testimonial .custom_paging {
            display: flex;
            width: 100%;
            justify-content: space-between;
            position: absolute;
            bottom: -35px;
            z-index: 1;
            left: 0%;
            align-items: center;
            top: 5%;
        }

        .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow,
        .ippi-testimonial .ippi-testimonial-slick-next.slick-arrow {
            right: -52px;
            width: 60px !important;
            height: 55px !important;
            position: absolute;
        }

        .ippi-testimonial .custom_paging p {
            margin: 0;
            font: normal normal normal 22px/23px Gibson;
            letter-spacing: 0px;
            color: #000000;
        }

        .ippi-testimonial .slick-arrow {
            cursor: pointer;
            font-size: 37px;
            font-weight: 700;
            height: 30px;
            line-height: 1;
            width: 14px;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow {
            transform: rotate(0deg);
            left: -52px;
            position: absolute;
        }

        .ippi-testimonial .ippi-testimonial-slick-next.slick-arrow {
            transform: rotate(180deg);
        }

        ul.slick-dots {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
        }

        ul.slick-dots li button {
            font-size: 0;
            padding: 0;
            border: 1px solid #E6E6E6;
            height: 15px;
            width: 15px;
            border-radius: 100px;
            background: #E6E6E6;
            margin: 0 10px;
        }

        ul.slick-dots li.slick-active button {
            background: #000;
        }

        @media (max-width:1735px) {
            .ippi-testimonial-item-image img {
                max-height: 345px;
            }
        }

        @media (max-width:1400px) {
            .ippi-testimonial-item-image img {
                max-height: 280px;
            }
        }

        @media (max-width:1201px) {
            .ippi-testimonial-item-image img {
                height: 300px;
            }

        }

        @media (max-width: 1800px) {
            .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow {
                left: 20px;
            }

            .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow,
            .ippi-testimonial .ippi-testimonial-slick-next.slick-arrow {
                right: 20px;
            }
        }

        @media (max-width: 1201px) and (min-width: 768px) {
            .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow {
                transform: rotate(0deg);
                left: 20px;
                position: absolute;
            }

            .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow,
            .ippi-testimonial .ippi-testimonial-slick-next.slick-arrow {
                right: 20px;
                width: 45px !important;
                height: 45px !important;
                position: absolute;
                top: 42%;
            }
        }

        @media (max-width: 767px) and (min-width: 280px) {
            .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow {
                left: 0px;
            }

            .ippi-testimonial .ippi-testimonial-slick-prev.slick-arrow,
            .ippi-testimonial .ippi-testimonial-slick-next.slick-arrow {
                right: 5px;
                width: 45px !important;
                height: 45px !important;
                position: absolute;
                top: 51%;
            }
        }

        @media (max-width:360px) {
            .ippi-testimonial .ippi-container {
                padding: 0 0px;
            }

        }

        /* Related Content Carousal End */
    </style>

<?php

    wp_reset_postdata();
}
