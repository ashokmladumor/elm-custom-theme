<?php

$section_heading = $settings['section_heading'];
$section_heading_toggle = $settings['section_heading_toggle'];
$include_term_ids = (isset($settings['include_term_ids'])) ? $settings['include_term_ids'] : [];
$col_count = $settings['col_count'];
$show_elements = $settings['show_elements'];
$post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
$show_load_more = $settings['event_loadmore_toggle'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$event_tab = $settings['event_tab'];
$event_tab_toggle = $settings['event_tab_toggle'];
$title = (isset($settings['title'])) ? $settings['title'] : '';
$link = (isset($settings['link'])) ? $settings['link'] : '';
$post_id = get_the_ID();
$post_types = get_post_type(get_the_ID());
//print_r($post_id);
//var_dump($event_tab_toggle);

$nav_label = array(
    'all'  => esc_html__('All', 'ippi-elementor-child'),
    'upcoming' => esc_html__('Upcoming', 'ippi-elementor-child'),
    'past-events' => esc_html__('Past Events', 'ippi-elementor-child'),
);
//var_dump($show_elements);


if ($event_tab_toggle != 'yes') {

    $show_elements = array($event_tab);
}
if ($show_load_more) {
    $args['posts_per_page'] = 6;
    $args['paged'] = $paged;
}
?>
<!--====== HTML CODING START ========-->
<div class="ippi-event-dropdown">
    <div class="ippi-container">
        <div class="ippi-event-heading-section <?php echo ($section_heading_toggle == 'yes') ? (!empty($title) ? ' ippi-border-b-2' : '') : ''; ?>">
            <?php if ($section_heading_toggle == 'yes') { ?>
                <h2 class="ippi-event-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
            <?php } ?>
            <div class="ippi-view-link-title">
                <?php if (!empty($settings['link']['url'])) {
                    $this->add_link_attributes('link', $settings['link']);
                } ?>
                <a class="ippi-view-link-tag" href="<?php echo $link['url']; ?>" <?php echo ($link['is_external']) ? 'target="_blank"' : '' ?>>
                    <span class="ippi-view-link-title"> <?php _e($title, 'ippi'); ?></span>
                </a>
            </div>
        </div>
        <?php if ($event_tab_toggle == 'yes') {
        ?>
            <ul class="ippi-table-content-dropdown">
                <?php
                $tab_na_counter = 1;
                foreach ($show_elements as $show_element) { ?>
                    <li class="<?php echo ($tab_na_counter == 1) ? 'active' : ''; ?>">
                        <a id="ippi_tab_item_event_<?php echo $show_element; ?>" href="#ippi_event_item_tab_wrapper_<?php echo $show_element; ?>" id="tabitemid" class="ippi_tab_item_event" data-value="<?php echo $show_element; ?>"><?php _e($nav_label[$show_element], 'ippi'); ?></a>
                    </li>
                <?php
                    $tab_na_counter++;
                } ?>
            </ul>
        <?php } ?>
        <div id="ippi_event_item_tab_wrapper" class="ippi_event_item_content_wrapper">
            <?php
            $tab_counter = 1;
            foreach ($show_elements as $show_element) {
                $args = array(
                    'post_status' => 'publish',
                    'post_type' => 'event',
                    'posts_per_page' => $post_per_page,
                    'fields' => 'ids',
                    'paged' => $paged,
                    'suppress_filters' => false,

                );
                if ($post_types == 'experts') {
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => 'event',
                        'posts_per_page' => $post_per_page,
                        'fields' => 'ids',
                        'paged' => $paged,
                        'suppress_filters' => false,
                    );
                    $args['meta_query'] = array(
                        'relation' => 'AND',
                        array(
                            'key' => 'related_experts',
                            'value' => $post_id,
                            'compare' => 'LIKE',
                        )
                    );
                }
                if (count($include_term_ids) > 0) {
                    $args['tax_query'] = array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'event_types',
                            'field' => 'id',
                            'terms' => $include_term_ids,
                        )
                    );
                }
                if ($show_element == 'upcoming') {
                    $args['meta_query'] = array(
                        array(
                            'key'     => 'event_date',
                            'value'       => date('Ymd'),
                            'compare'     => '>',
                            'type'        => 'NUMERIC'
                        )
                    );
                } else if ($show_element == 'past-events') {
                    $args['meta_query'] = array(
                        array(
                            'key'     => 'event_date',
                            'value'       => date('Ymd'),
                            'compare'     => '<',
                            'type'        => 'NUMERIC'
                        )
                    );
                }
                $the_query = new WP_Query($args);
                $total_post = $the_query->found_posts;
                $max_num_pages = $the_query->max_num_pages;
            ?>

                <div id="ippi_event_item_tab_wrapper_<?php echo $show_element; ?>" class="ippi-tab-content ippi_select-event-dropdown <?php echo ($tab_counter == 1) ? 'active' : ''; ?>">
                    <div class="ippi-grid-row event-tab-content-inner">
                        <?php
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post();
                                $id = get_the_ID();

                                $image = get_the_post_thumbnail($post, 'full');
                                $terms = get_the_terms(get_the_ID(), 'event_types');
                        ?>
                                <div class="ippi-grid-col-1/<?php echo $col_count; ?> ippi-event-content-item">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <div class="ippi-event-content-item-wrapper">
                                            <div class="ippi-event-content-item-image">
                                                <?php _e($image, 'ippi'); ?>
                                                <br />
                                                <span class="ippi-event-content-item-content-type">
                                                    <?php if ($terms) {
                                                        foreach ($terms as $term) {
                                                            _e($term->name, 'ippi');
                                                        }
                                                    }
                                                    ?> <?php _e('•', 'ippi'); ?>
                                                    <?php $date = get_field('event_date', get_the_ID());
                                                    $register = get_field('registration_text');
                                                    if ($date) {
                                                        _e($date, 'ippi');
                                                    } elseif ($register) {
                                                        echo $register;
                                                    }

                                                    ?>
                                                </span>
                                            </div>
                                            <div class="ippi-event-content-item-content-area ">
                                                <div class="ippi-event-content-item-heading">
                                                    <h3 class="ippi-event-content-item-title">
                                                        <span class="ippi-event-content-item-content-type">
                                                            <?php if ($terms) {
                                                                foreach ($terms as $term) {
                                                                    _e($term->name, 'ippi');
                                                                }
                                                            } ?><?php _e('|', 'ippi'); ?>
                                                        </span>

                                                        <span class="ippi-event-content-item-title-main"> <?php echo get_the_title(); ?> </span>
                                                    </h3>
                                                </div>
                                                <div class="ippi-event-content-item-description">
                                                    <p><?php echo get_the_excerpt(); ?></p>
                                                </div>
                                                <div class="ippi-event-content-item-details">
                                                    <span class="ippi-event-content-item-date"> <?php echo get_the_date('j F Y'); ?> - </span>
                                                    <span class="ippi-event-content-item-view-count"> <?php echo get_the_time(); ?></span>
                                                    <span class="ippi-event-content-item-view-count">
                                                        <?php $register = get_field('registration_text');
                                                        if ($register) {
                                                            _e('• ', 'ippi');
                                                            echo $register; ?>
                                                        <?php } else {
                                                        } ?>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                            endwhile;
                        endif; ?>
                    </div>
                    <?php if (($max_num_pages > $paged) && $show_load_more) { ?>

                        <a href="#" class="ippi-btn-hover-black-left" id="ippi-publication-load-more" onclick="load_events(event, this);" data-page="1" data-post_per_page="<?php echo $post_per_page; ?>" data-maxpages="<?php echo $max_num_pages; ?>" data-eventtype="<?php echo $show_element; ?>" data-terms="<?php echo htmlspecialchars(json_encode($include_term_ids)); ?>"><span class="elementor-button-content-wrapper"><span class="elementor-button-text"><?php _e('Load More', 'ippi'); ?></span></span></a>


                    <?php } ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php
                $tab_counter++;
            } ?>
        </div>
    </div>

</div>

<div class="ippi-event-content-wrapper ippi-container">
    <div class="select-event-dropdown ippi-grid-row" id="ippi-events-wrapper" show_elements="<?php echo $show_elements; ?>" totle-page="<?php echo $totle_page; ?>" current_page="1" section_heading="<?php echo htmlspecialchars(json_encode($section_heading)); ?>" include_term_ids="<?php echo htmlspecialchars(json_encode($include_term_ids)); ?>" post_per_page="<?php echo htmlspecialchars(json_encode($post_per_page)); ?>" col_count="<?php echo htmlspecialchars(json_encode($col_count)); ?>">
    </div>
</div>
<style>
    .ippi-event-heading-section {
        /* display: flex; */
        justify-content: space-between;
        width: 100%;
    }

    .ippi-border-b-2 {
        border-bottom: 2px solid #000;
        margin-bottom: 25px;
        display: flex;
    }

    .ippi_select-event-dropdown.ippi-grid-row {
        display: none;
    }

    .ippi_select-event-dropdown.ippi-grid-row.active {
        display: flex;
    }
</style>
<script>
    function load_events(e, el) {
        e.preventDefault();
        var dpage = jQuery(el).attr('data-page');
        var dpageper = jQuery(el).attr('data-post_per_page');
        var dmaxpages = jQuery(el).attr('data-maxpages');
        var deventtype = jQuery(el).attr('data-eventtype');
        var dterms = jQuery(el).attr('data-terms');
        var col_count = jQuery(el).attr('data-col_count');
        console.log(dpage, dpageper, dmaxpages, deventtype, dterms);
        dpage = parseInt(dpage) + 1;
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo get_site_url();?>/wp-admin/admin-ajax.php',
            dataType: "html", // add data type
            data: {
                action: 'get_ajax_posts',
                include_term_ids: dterms,
                post_per_page: dpageper,
                col_count: col_count,
                paged: dpage,
                totle_page: dmaxpages,
                show_elements: deventtype,
            },
            success: function(response) {
                jQuery(el).attr('data-page', dpage);
                jQuery(el).parents('.ippi-tab-content').first().find('.event-tab-content-inner').first().append(response);
                console.log(dmaxpages, '==', dpage);
                if (dmaxpages == dpage) {
                    jQuery(el).hide();
                }
            }
        });

    }

    jQuery(document).ready(function() {
        var tab_nav = jQuery('.ippi_tab_item_event');
        tab_nav.click(function(e) {
            e.preventDefault();
            var id = jQuery(this).attr('href');
            jQuery('.ippi-tab-content').removeClass('active');
            jQuery(id).toggleClass('active');
            jQuery(this).parents('ul').find('li').removeClass('active');
            jQuery(this).parent('li').addClass('active');
        });

    });
</script>