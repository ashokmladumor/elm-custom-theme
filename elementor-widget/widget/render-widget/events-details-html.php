<?php

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$section_heading_toggle = $settings['section_heading_toggle'];


$args = array(
    'post_status' => 'publish',
    'post_type' => 'event',
);
$the_query = new WP_Query($args);
$terms = get_the_terms(get_the_ID(), 'event_types');

?>


<div class="ippi-event-details">
    <div class="ippi-container">
        <div class="ippi-event-details-heading-section">
            <?php if ($section_heading_toggle == 'yes') { ?>
                <h2 class="ippi-event-details-section-title"><?php echo ($section_heading) ? __($section_heading,'ippi') : __('Events Details', 'ippi'); ?></h2>
            <?php } ?>
        </div>
        <div class="ippi-event-details-content">
            <ul>
                <?php if ($terms) {  ?>
                    <li>
                        <div class="ippi-event-details-terms" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/calender.svg' ?>)">

                            <?php foreach ($terms as $term) {
                                _e($term->name, 'ippi');
                            } ?>
                        </div>
                    </li>
                <?php } ?>
                <?php if (get_field('event_date')) { ?>
                    <li>
                        <div class="ippi-event-details-date" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/clock.svg' ?>)">
                            <?php echo get_field('event_date', get_the_ID()); ?>
                        </div>
                    </li>
                <?php }  ?>
                <?php if (get_field('event_time')) { ?>
                    <li>
                        <div class="ippi-event-details-time" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/calender.svg' ?>)">
                            <?php echo get_field('event_time', get_the_ID()); ?><?php echo get_field('timezone', get_the_ID()); ?>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div class="ippi-event-details-online" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/location.svg' ?>)">
                        <?php if (get_field('online')) {
                            _e("Online", 'ippi');
                        } else {
                            _e("Offline", 'ippi');
                        }
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>


<style>
    .ippi-event-details-date,
    .ippi-event-details-terms,
    .ippi-event-details-time,
    .ippi-event-details-online {
        background-repeat: no-repeat;
        padding-left: 30px;
        background-position: left center;
        background-size: 20px;
        padding: 5px 0px 0px 35px;
    }

    h2.ippi-expertise-title_topics {
        font: normal normal 600 24px/29px Gibson !important;
        letter-spacing: 0px;
        margin-top: 0;
        color: #000000;
        padding-bottom: 18px;
        border-bottom: 2px solid #000;
        margin-bottom: 26px;
    }

    h2.ippi-event-details-section-title {
        font: normal normal 600 24px/29px Gibson !important;
        letter-spacing: 0px;
        margin-top: 0;
        color: #000000;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
        margin-bottom: 12px;
    }

    .ippi-section-topics {
        padding: 0px 20px;
    }

    li.ippi-expertise-list-item_topics a {
        transition: 0.3s all ease-in;
        background-color: transparent;
        border: 2px solid #000;
        text-decoration: none;
        display: block;
        padding-right: 13px;
        padding-left: 19px;
        font: normal normal normal 16px/48px Gibson !important;
        letter-spacing: 0.4px;
        color: #000000;
    }

    .ippi-event-details-register-button {
        padding: 8px 4px;
        border: 2px solid #000000;
        margin: 15px 279px 0px 0px;
        text-align: center;
        font: normal normal normal 20px/37px Gibson;
        letter-spacing: 0px;
    }

    .ippi-event-details-register-button a {
        color: #000;

    }
</style>