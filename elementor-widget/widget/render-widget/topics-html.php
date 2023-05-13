<?php

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$selected_taxonomy = (isset($settings['selected_taxonomy'])) ? $settings['selected_taxonomy'] : '';
$current_post = get_post(get_the_ID());
$terms = wp_get_post_terms(get_the_ID(), $selected_taxonomy);


if (is_tax()) {
    $terms = [];
    $current_term = get_queried_object();
    $_topics = get_field('topics', $current_term);
    foreach ($_topics as $topic) {
        $terms[] = get_term($topic, 'topics');
    }
}
?>

<div class="ippi-section-topics">
    <div class="ippi-topics">
        <div class="ippi-topics-wrapper">
            <div class="ippi-topics-heading">
                <h2 class="ippi-topics-title ippi-expertise-title_<?php echo $selected_taxonomy; ?>"><?php echo ($section_heading) ? __($section_heading,'ippi') : __('Topics', 'ippi'); ?></h2>
            </div>
            <div class="ippi-all-topics">
                <ul class="ippi-topics-list">
                    <?php
                    foreach ($terms as $term) {
                    ?>
                        <li class="ippi-topics-list-item ippi-expertise-list-item_<?php echo $selected_taxonomy; ?>">
                            <a href="<?php echo get_term_link($term->slug, $selected_taxonomy);?>"><?php _e($term->name, 'ippi'); ?></a>
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
    h2.ippi-expertise-title_expertise {
        font: normal normal 600 24px/29px Gibson !important;
        letter-spacing: 0px;
        margin-top: 0;
        color: #000000;
        padding-bottom: 18px;
        border-bottom: 2px solid #000;
        margin-bottom: 34px;
    }

    h2.ippi-topics-title {
        font: normal normal 600 50px/60px Gibson;
        letter-spacing: 0px;
        color: #000000;
        margin: 0;
        margin-bottom: 38px;
    }

    ul.ippi-topics-list {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    li.ippi-topics-list-item {
        padding-left: 5px;
        padding-right: 5px;
        margin-bottom: 10px;
    }

    li.ippi-topics-list-item a {
        transition: 0.3s all ease-in;
        background-color: transparent;
        border: 1px solid #000;
        text-decoration: none;
        display: block;
        padding-right: 13px;
        padding-left: 19px;
        color: #000000;
    }

    li.ippi-expertise-list-item_expertise a {
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

    li.ippi-topics-list-item a:hover {
        background: black;
        color: #fff;
    }
</style>
<?php
wp_reset_postdata();
