<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$include_term_ids = (isset($settings['include_term_ids'])) ? $settings['include_term_ids'] : [];
$col_count = (isset($settings['col_count'])) ? $settings['col_count'] : 3;
$show_elements = (isset($settings['show_elements'])) ? $settings['show_elements'] : '';
$post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;


$expert_tab_all = array('all' => 'All');

$experts_tab = (isset($settings['experts_tab'])) ? $settings['experts_tab'] : '';

$experts_tab = array_merge($expert_tab_all, $experts_tab);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>
<!--====== HTML CODING START ========-->
<div class="ippi-event-dropdown">
    <div class="ippi-container">
        <h2 class="ippi-event-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        <ul class="ippi-table-content-dropdown">
            <?php
            $tab_na_counter = 1;
            foreach ($experts_tab as $experts_id) {
                $expert_type = 'all';
                if($experts_id != 'All'){
                    $expert_type = get_term($experts_id, 'expert-type');
                }
            ?>
                <li class="<?php echo ($tab_na_counter == 1) ? 'active' : ''; ?>">
                    <a id="ippi_tab_item_event_<?php echo $experts_id; ?>" href="#ippi_event_item_tab_wrapper_<?php echo $experts_id; ?>" id="tabitemid" class="ippi_tab_item_event" data-value="<?php echo $experts_id; ?>"><?php echo ($expert_type == 'all') ? 'All' : $expert_type->name; ?></a>
                </li>
            <?php
                $tab_na_counter++;
            } ?>
        </ul>
        <div id="ippi_event_item_tab_wrapper" class="ippi_event_item_content_wrapper ippi-container">
            <?php
            $tab_counter = 1;
            foreach ($experts_tab as $experts_id) {
                $args = array(
                    'post_status' => 'publish',
                    'post_type' => 'experts',
                    'posts_per_page' => $post_per_page,
                    'fields' => 'ids',
                    'paged' => $paged
                );
                if ($experts_id && $experts_id != 'All') {
                    $args['tax_query'] = array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'expert-type',
                            'field' => 'id',
                            'terms' => $experts_id,
                        )
                    );
                }
                $the_query = new WP_Query($args);
                $total_post = $the_query->found_posts;
                $max_num_pages = $the_query->max_num_pages;
            ?>

                <div id="ippi_event_item_tab_wrapper_<?php echo $experts_id; ?>" class="ippi-tab-content ippi_select-event-dropdown ippi-grid-row <?php echo ($tab_counter == 1) ? 'active' : ''; ?>">
                    <div class="ippi-grid-row event-tab-content-inner">
                        <?php
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post();
                                $id = get_the_ID();

                                $image = get_the_post_thumbnail($post, 'thumbnail');
                                $terms = get_the_terms(get_the_ID(), 'expertise');
                        ?>
                                <div class="ippi-grid-col-1/<?php echo $col_count; ?> ippi-expert-content-item">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <div class="ippi-expert-content-item-wrapper">
                                            <div class="ippi-expert-content-item-image">
                                                <?php _e($image, 'ippi'); ?>
                                            </div>
                                            <div class="ippi-expert-content-item-content-area ">
                                                <h3 class="ippi-expert-content-item-title">
                                                    <?php echo get_the_title(); ?>
                                                </h3>
                                                <div class="ippi-expert-content-item-description">
                                                    <p><?php echo get_post_meta($id, 'designation', true); ?></p>
                                                </div>
                                                <div class="ippi-expert-content-item-details">
                                                    <?php if ($terms) {
                                                        $expertise = [];
                                                        foreach ($terms as $term) {
                                                            $expertise[] = $term->name;
                                                        }
                                                    }
                                                    echo implode(', ', $expertise);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                            endwhile;
                        endif; ?>
                    </div>
                    <?php if ($max_num_pages > $paged) { ?>
                        <!-- <a href="#" class="ippi-btn-hover-black-left" id="ippi-publication-load-more" onclick="load_events(event, this);" data-page="1" data-post_per_page="<?php echo $post_per_page; ?>" data-maxpages="<?php echo $max_num_pages; ?>" data-eventtype="<?php echo $show_element; ?>" data-terms="<?php echo htmlspecialchars(json_encode($include_term_ids)); ?>">
                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-text"><?php _e('Load More', 'ippi'); ?></span>
                                        </span>
                    </a> -->
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
    .ippi_select-event-dropdown.ippi-grid-row {
        display: none;
    }

    .ippi_select-event-dropdown.ippi-grid-row.active {
        display: flex;
    }

    .ippi-expert-content-item-wrapper {
        display: flex;
        padding: 27px 19px;
        background: #F5F7F6;
        width: 545px !important;
        height: 273px !important;
    }

    .ippi-expert-content-item-image {
        width: 30%;
    }

    .ippi-expert-content-item-image img {
        border-radius: 100%;
        width: 120px;
        height: 120px;
        display: inline-block;
    }

    .ippi-expert-content-item-content-area {
        width: 70%;
    }

    .ippi-expert-content-item-title {
        font-size: 30px;
        line-height: 30px;
        color: #000;
    }

    .ippi-expert-content-item-description {
    font-size: 20px;
    line-height: 26px;
    color: #000;
    /* margin-bottom: 30px; */
    padding-top: 7px;
}
.ippi-expert-content-item-details {
    font-size: 17px;
    line-height: 26px;
    color: #696969;
    padding-top: 43px;
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
            url: 'https://ippi.fatfish.co.il/wp-admin/admin-ajax.php',
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