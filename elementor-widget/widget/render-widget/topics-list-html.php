<?php

$section_heading = $settings['section_heading'];
$section_heading_toggle = $settings['section_heading_toggle'];
$include_term_ids = (isset($settings['include_term_ids'])) ? $settings['include_term_ids'] : [];
$col_count = $settings['col_count'];
$show_elements = $settings['show_elements'];
$post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
$show_load_more = $settings['topic_loadmore_toggle'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$topic_tab = $settings['topic_tab'];
$topic_tab_toggle = $settings['topic_tab_toggle'];
$title = (isset($settings['title'])) ? $settings['title'] : '';
$link = (isset($settings['link'])) ? $settings['link'] : '';

// $post_id = get_the_ID();
// $post_types = get_post_type(get_the_ID());
//print_r($post_id);
//var_dump($event_tab_toggle);

$nav_label = array(
    'all'  => esc_html__('All', 'ippi-elementor-child'),
    'technology' => esc_html__('Technology', 'ippi-elementor-child'),
    'environment' => esc_html__('Environment', 'ippi-elementor-child'),
);
//var_dump($show_elements);


if ($topic_tab_toggle != 'yes') {

    $show_elements = array($topic_tab);
}
if ($show_load_more) {
    $args['posts_per_page'] = 6;
    $args['paged'] = $paged;
}
?>
<!--====== HTML CODING START ========-->
<div class="ippi-topic-list-dropdown">
    <div class="ippi-container">
        <?php if ($topic_tab_toggle == 'yes') {
        ?>
            <ul class="ippi-table-content-dropdown">
                <?php
                $tab_na_counter = 1;
                foreach ($show_elements as $show_element) { ?>
                    <li class="<?php echo ($tab_na_counter == 1) ? 'active' : ''; ?>">
                        <a id="ippi_tab_item_topic_<?php echo $show_element; ?>" href="#ippi_topic_item_tab_wrapper_<?php echo $show_element; ?>" id="tabitemid" class="ippi_tab_item_event" data-value="<?php echo $show_element; ?>"><?php _e($nav_label[$show_element], 'ippi'); ?></a>
                    </li>
                <?php
                    $tab_na_counter++;
                } ?>
            </ul>
        <?php } ?>
        <div id="ippi_topic_item_tab_wrapper" class="ippi_topic_item_content_wrapper">
            <?php
            $tab_counter = 1;

            // foreach ($show_elements as $show_element) {
                
                
            ?>

                <div id="ippi_topic_list_item_tab_wrapper_<?php echo $show_element; ?>" class="ippi-tab-content ippi_select-topic-list-dropdown <?php echo ($tab_counter == 1) ? 'active' : ''; ?>">
                    <div class="ippi-grid-row topic-list-tab-content-inner">
                        <?php

                        $topics = get_terms( 'topics', 'orderby=count&hide_empty=0' );


                        foreach ($topics as $topic) {
                            // echo'<pre>';
                            // print_r(get_field("topic_featured_image", 'topics_'. $topic->term_id));
                            // echo'</pre>';

                            
                        ?>
                                <div class="ippi-grid-col-1/<?php echo $col_count; ?> ippi-topic-list-content-item">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <div class="ippi-topic-list-content-item-wrapper">
                                            <div class="ippi-topic-list-content-item-image">
                                            <?php echo "<img src='".get_field("topic_featured_image", 'topics_'. $topic->term_id)."' /><br>"; ?>
                                                <br>
                                                <div class="ippi-topic-list-content-item-content-area ">
                                                    <div class="ippi-topic-list-content-item-heading">
                                                        <h3 class="ippi-topic-list-content-item-title">
                                                            <span class="ippi-topic-list-content-item-title-main"> <?php echo $topic->name; ?> </span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                          }
                          ?>
                    </div>
                    
                </div>
                <?php wp_reset_postdata(); ?>
            <?php
                $tab_counter++;
            // }
             ?>
        </div>
    </div>

</div>
<style>
    .ippi-topic-list-heading-section {
        /* display: flex; */
        justify-content: space-between;
        width: 100%;
    }

    .ippi-border-b-2 {
        border-bottom: 2px solid #000;
        margin-bottom: 25px;
        display: flex;
    }

    .ippi_select-topic-list-dropdown.ippi-grid-row {
        display: none;
    }

    .ippi_select-topic-list-dropdown.ippi-grid-row.active {
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