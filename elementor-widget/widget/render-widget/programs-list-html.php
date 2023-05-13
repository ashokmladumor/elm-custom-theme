<?php
$section_heading = $settings['section_heading'];
$section_heading_toggle = $settings['section_heading_toggle'];
$col_count = $settings['col_count'];
$show_elements = $settings['show_elements'];
$post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$show_load_more = $settings['program_loadmore_toggle'];
$program_tab = $settings['program_tab'];
$program_tab_toggle = $settings['program_tab_toggle'];

$programs_related_activity = $settings['programs_related_activity'];
$programs_related_partners = $settings['programs_related_partners'];
$include_programs_tag_ids = $settings['include_programs_tag_ids'];
$include_programs_term_ids = $settings['include_programs_term_ids'];

$nav_label = array(
    'all-programs'  => esc_html__('All programs', 'ippi-elementor-child'),
    'current-programs' => esc_html__('Current programs', 'ippi-elementor-child'),
    'past-programs' => esc_html__('Past programs', 'ippi-elementor-child'),
);

if ($program_tab_toggle != 'yes') {

    $show_elements = array($program_tab);
}

if ($show_load_more) {
    $args['posts_per_page'] = 6;
    $args['paged'] = $paged;
}
?>
<!--====== HTML CODING START ========-->
<div class="ippi-event-dropdown">
    <div class="ippi-container">
        <?php if ($section_heading_toggle == 'yes') { ?>
            <h2 class="ippi-event-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
        <?php } ?>
        <?php if ($program_tab_toggle == 'yes') {
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
        <div id="ippi_event_item_tab_wrapper" class="ippi_event_item_content_wrapper ippi-container">
            <?php
            $tab_counter = 1;
            foreach ($show_elements as $show_element) {
                $args = array(
                    'post_status' => 'publish',
                    'post_type' => 'program',
                    'posts_per_page' => $post_per_page,
                    'fields' => 'ids',
                    'paged' => $paged
                );

                if ($show_element == 'current-programs') {
                    $args['meta_query'] = array(
                        'relation'    => 'AND',
                        array(
                            'key'     => 'program_start_date',
                            'value'       => date('Ymd'),
                            'compare'     => '<=',
                            'type'        => 'NUMERIC'
                        ),
                        array(
                            'key'     => 'program_end_date',
                            'value'       => date('Ymd'),
                            'compare'     => '>',
                            'type'        => 'NUMERIC'
                        )
                    );
                } else if ($show_element == 'past-programs') {
                    $args['meta_query'] = array(
                        array(
                            'key'     => 'program_end_date',
                            'value'       => date('Ymd'),
                            'compare'     => '<',
                            'type'        => 'NUMERIC'
                        )

                    );
                }

                 //this code is run when only this element is in single post type page
                 if( is_single() ){

                    $args['post_type'] = array( 'program', 'projects', 'event', 'fellowship', 'partner', 'job_and_fellowship' );

                    $current_post_id =  get_the_ID();
                    $related_act = [];
                    if( $programs_related_activity ){
                        foreach($programs_related_activity as $activity){
                            @$new_act = array_merge($related_act, array_column( get_field($activity, $current_post_id), 'ID') );
                            $related_act = $new_act;                            
                        }                        
                    }

                    if( $programs_related_partners ){
                        foreach($programs_related_partners as $activity){
                            @$new_act = array_merge($related_act, array_column( get_field($activity, $current_post_id), 'ID') );
                            $related_act = $new_act;                            
                        }                    
                    }

                    if( $programs_related_activity || $programs_related_partners){
                        $args['post__in'] = $related_act;
                    }
                    

                    if( !empty ( $include_programs_tag_ids ) && !empty( $include_programs_term_ids ) ){ 
                        $args['tax_query']['relation'] = 'OR';
                    }

                    if( !empty ( $include_programs_tag_ids ) ){
                        // $terms = [];                        
                        foreach ($include_programs_tag_ids as $term_id) {
                            $term = get_term($term_id);
                            $term_array[$term->taxonomy][] = $term_id;
                            $args['tax_query'][$term->taxonomy] = array(
                                'taxonomy' => $term->taxonomy,
                                'field' => 'id',
                                'terms' => $term_array[$term->taxonomy],
                            );
                        }                        
                    }   

                    if( !empty( $include_programs_term_ids ) ){
                        // $terms = [];                        
                        foreach ($include_programs_term_ids as $term_id) {
                            $term = get_term($term_id);
                            $term_array[$term->taxonomy][] = $term_id;
                            $args['tax_query'][$term->taxonomy] = array(
                                'taxonomy' => $term->taxonomy,
                                'field' => 'id',
                                'terms' => $term_array[$term->taxonomy],
                            );
                        }                       
                    }   
                   
                }

                $the_query = new WP_Query($args);
                $total_post = $the_query->found_posts;
                $max_num_pages = $the_query->max_num_pages;
            ?>

                <div id="ippi_event_item_tab_wrapper_<?php echo $show_element; ?>" class="ippi-tab-content ippi_select-event-dropdown ippi-grid-row <?php echo ($tab_counter == 1) ? 'active' : ''; ?>">
                    <div class="ippi-grid-row event-tab-content-inner">
                        <?php
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post();
                                $id = get_the_ID();

                                $image = get_the_post_thumbnail($post, 'full');

                        ?>
                                <div class="ippi-grid-col-1/<?php echo $col_count; ?> ippi-program-content-item">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <div class="ippi-program-content-item-wrapper">
                                            <div class="ippi-program-content-item-image">
                                                <?php echo $image; ?>
                                                <br />
                                                <span class="ippi-program-content-item-content-type ippi-open-item ippi-close-item">

                                                    <?php $status = get_field('program_status', get_the_ID());
                                                    _e($status,'ippi'); ?>
                                                </span>
                                            </div>
                                            <div class="ippi-program-content-item-content-area ">
                                                <div class="ippi-program-content-item-heading">
                                                    <h3 class="ippi-program-content-item-title">
                                                        <span class="ippi-program-content-item-title-main"> <?php echo get_the_title(); ?> </span>
                                                    </h3>
                                                </div>
                                                <div class="ippi-program-content-item-description">
                                                    <p><?php echo wp_trim_words(get_the_excerpt(), 15);  ?></p>
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
                        <a href="#" class="" onclick="load_programs(program, this);" data-page="1" data-post_per_page="<?php echo $post_per_page; ?>" data-maxpages="<?php echo $max_num_pages; ?>" data-programtype="<?php echo $show_element; ?>" data-terms="<?php echo htmlspecialchars(json_encode($include_term_ids)); ?>"><?php _e('Load More','ippi');?></a>
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

</style>
<script>
    function load_programs(e, el) {
        e.preventDefault();
        var dpage = jQuery(el).attr('data-page');
        var dpageper = jQuery(el).attr('data-post_per_page');
        var dmaxpages = jQuery(el).attr('data-maxpages');
        var dprogramtype = jQuery(el).attr('data-programtype');
        var dterms = jQuery(el).attr('data-terms');
        var col_count = jQuery(el).attr('data-col_count');
        console.log(dpage, dpageper, dmaxpages, dprogramtype, dterms);
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
                show_elements: dprogramtype,
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