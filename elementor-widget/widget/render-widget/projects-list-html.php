<?php
$section_heading = $settings['section_heading'];
$section_heading_toggle = $settings['section_heading_toggle'];
$col_count = $settings['col_count'];
$show_elements = $settings['show_elements'];
$post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$show_load_more = $settings['project_loadmore_toggle'];
$project_tab = $settings['project_tab'];
$project_tab_toggle = $settings['project_tab_toggle'];
$project_related_activity = $settings['project_related_activity'];
$project_related_partners = $settings['project_related_partners'];
$include_project_tag_ids = $settings['include_project_tag_ids'];
$include_project_term_ids = $settings['include_project_term_ids'];

$nav_label = array(
    'all-projects'  => esc_html__('All projects', 'ippi-elementor-child'),
    'current-projects' => esc_html__('Current projects', 'ippi-elementor-child'),
    'past-projects' => esc_html__('Past projects', 'ippi-elementor-child'),
);

if ($project_tab_toggle != 'yes') {

    $show_elements = array($project_tab);
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
        <?php if ($project_tab_toggle == 'yes') {
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
                    'post_type' => 'projects',
                    'posts_per_page' => $post_per_page,
                    'fields' => 'ids',
                    'paged' => $paged
                );

                if ($show_element == 'current-projects') {
                    $args['meta_query'] = array(
                        'relation'    => 'AND',
                        array(
                            'key'     => 'project_start_date',
                            'value'       => date('Ymd'),
                            'compare'     => '<=',
                            'type'        => 'NUMERIC'
                        ),
                        array(
                            'key'     => 'project_end_date',
                            'value'       => date('Ymd'),
                            'compare'     => '>',
                            'type'        => 'NUMERIC'
                        )
                    );
                } else if ($show_element == 'past-projects') {
                    $args['meta_query'] = array(
                        array(
                            'key'     => 'project_end_date',
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
                    if($project_related_activity){
                        foreach($project_related_activity as $activity){
                            @$new_act = array_merge($related_act, array_column( get_field($activity, $current_post_id), 'ID') );
                            $related_act = $new_act;                            
                        }                
                    }

                    if($project_related_partners){
                        foreach($project_related_partners as $activity){
                            @$new_act = array_merge($related_act, array_column( get_field($activity, $current_post_id), 'ID') );
                            $related_act = $new_act;                            
                        }                
                    }

                    if( $project_related_activity || $project_related_partners){
                        $args['post__in'] = $related_act;
                    }

                    if( !empty ( $include_project_tag_ids ) && !empty( $include_project_term_ids ) ){ 
                        $args['tax_query']['relation'] = 'OR';
                    }

                    if( !empty ( $include_project_tag_ids ) ){
                        // $terms = [];                        
                        foreach ($include_project_tag_ids as $term_id) {
                            $term = get_term($term_id);
                            $term_array[$term->taxonomy][] = $term_id;
                            $args['tax_query'][$term->taxonomy] = array(
                                'taxonomy' => $term->taxonomy,
                                'field' => 'id',
                                'terms' => $term_array[$term->taxonomy],
                            );
                        }                        
                    }   

                    if( !empty( $include_project_term_ids ) ){
                        // $terms = [];                        
                        foreach ($include_project_term_ids as $term_id) {
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
                                <div class="ippi-grid-col-1/<?php echo $col_count; ?> ippi-project-content-item">
                                    <a href="<?php echo get_the_permalink() ?>">
                                        <div class="ippi-project-content-item-wrapper">
                                            <div class="ippi-project-content-item-image">
                                                <?php echo $image; ?>
                                                <br />
                                                <?php if( get_field('project_status', get_the_ID() ) ) :  ?>
                                                <span class="ippi-project-content-item-content-type">
                                                    <?php $status = get_field('project_status', get_the_ID() );
                                                    _e($status, 'ippi'); ?>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ippi-project-content-item-content-area ">
                                                <div class="ippi-project-content-item-heading">
                                                    <h3 class="ippi-project-content-item-title">
                                                        <span class="ippi-project-content-item-title-main"> <?php echo get_the_title(); ?> </span>
                                                    </h3>
                                                </div>
                                                <div class="ippi-project-content-item-description">
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
                        <a href="#" class="" onclick="load_projects(project, this);" data-page="1" data-post_per_page="<?php echo $post_per_page; ?>" data-maxpages="<?php echo $max_num_pages; ?>" data-projecttype="<?php echo $show_element; ?>" data-terms="<?php echo htmlspecialchars(json_encode($include_term_ids)); ?>"><?php _e('Load More', 'ippi');?></a>
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
    function load_projects(e, el) {
        e.preventDefault();
        var dpage = jQuery(el).attr('data-page');
        var dpageper = jQuery(el).attr('data-post_per_page');
        var dmaxpages = jQuery(el).attr('data-maxpages');
        var dprojecttype = jQuery(el).attr('data-projecttype');
        var dterms = jQuery(el).attr('data-terms');
        var col_count = jQuery(el).attr('data-col_count');
        console.log(dpage, dpageper, dmaxpages, dprojecttype, dterms);
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
                show_elements: dprojecttype,
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