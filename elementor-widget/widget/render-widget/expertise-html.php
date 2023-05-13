<?php

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$current_post = get_post(get_the_ID());


$terms = wp_get_post_terms(get_the_ID(), 'expertise');
?>

<div class="ippi-section-expertise">
    <div class="ippi-expertise">
        <div class="ippi-expertise-wrapper">
            <div class="ippi-expertise-heading">
                <h2 class="ippi-expertise-title"><?php _e($section_heading, 'ippi') ? $section_heading : __('Expertise', 'ippi'); ?></h2>
            </div>
            <div class="ippi-all-expertise">
                <ul class="ippi-expertise-list">
                    <?php
                    foreach ($terms as $term) {
                    ?>
                        <li class="ippi-expertise-list-item">
                            <a href="javascript:void(0)"><?php _e($term->name, 'ippi'); ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    h2.ippi-expertise-title {
        font: normal normal 600 24px/29px Gibson;
        letter-spacing: 0px;
        margin-top: 0;
        color: #000000;
        padding-bottom: 18px;
        border-bottom: 2px solid #000;
        margin-bottom: 34px;
    }

    ul.ippi-expertise-list {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    li.ippi-expertise-list-item {
        padding-left: 5px;
        padding-right: 5px;
        margin-bottom: 10px;
    }

    li.ippi-expertise-list-item a {
        transition: 0.3s all ease-in;
        background-color: transparent;
        border: 2px solid #000;
        text-decoration: none;
        display: block;
        padding-right: 13px;
        padding-left: 19px;
        font: normal normal normal 16px/48px Gibson;
        letter-spacing: 0.4px;
        color: #000000;
    }

    li.ippi-expertise-list-item a:hover {
        background: black;
        color: #fff;
    }
</style>
<?php
wp_reset_postdata();
