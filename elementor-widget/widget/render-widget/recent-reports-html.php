<?php

$section_heading = $settings['section_heading'];
$selected_recent_reports = $settings['recent_reports_selected_posts'];
$post_per_page = ($settings['report_per_page']) ? $settings['report_per_page'] : 4;
$show_load_more = $settings['report_loadmore_toggle'];
//$paged = intval($_POST['dpageper']);

$args = array(
    'post_type' => array('post-report'),
    'post_status' => 'publish',
    //'post__in' => $selected_recent_reports,
);

if(is_archive()) {
    
    $args['tax_query'] = array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'issue_areas',
            'field' => 'id',
            'terms' => array(get_queried_object()->term_id),
        )
    );
}

if ($selected_recent_reports && !$show_load_more) {
    $args['post__in'] = $selected_recent_reports;
}

if ($show_load_more) {
    $args['posts_per_page'] = $post_per_page;
    //$args['paged'] = $paged;
}

$related_content = new WP_Query($args);
// create hidden field > input , id=tax-id name = tax-id, < value : current term id
$max_num_pages = $related_content->max_num_pages;
$view = "View All";
if ($related_content->have_posts()) {
?>



    <!--====== HTML CODING START ========-->
    <div class="ippi-recent-report">
        <div class="ippi-recent-report-container ippi-content-view-all">
            <h2 class="ippi-recent-report-section-title"><?php _e($section_heading, 'ippi'); ?></h2>
            <a class="ippi-content-view-all" href="#"><?php _e($view, 'ippi'); ?></a>

        </div>
        <div class="ippi-recent-reports-content-wrapper ippi-recent-report-container">
            <div class="ippi-recent-reports">
                <?php
                while ($related_content->have_posts()) : $related_content->the_post();
                    //$post = get_post();
                    $id = get_the_ID();
                    $image = get_the_post_thumbnail($id, 'full');
                    $term_obj_list = get_the_terms(get_the_ID(), 'report-category');
                    $report_terms = join(', ', wp_list_pluck($term_obj_list, 'name'));
                    $display_terms = ($report_terms) ? $report_terms . " | " : '';


                    include(plugin_dir_path(__FILE__) . '/template-part/recent-report-loop-item.php');

                endwhile;
                ?>
            </div>
            <?php if (($max_num_pages > $paged) && $show_load_more) { ?>
                <div class="ippi-rr-load-more-btn">
                    <a href="javascript:void(0);" class="ippi-btn-hover-black-left" onclick="load_recent_reports(this);" data-page="1" data-post_per_page="<?php echo $post_per_page; ?>" data-maxpages="<?php echo $max_num_pages; ?>"><span class="elementor-button-content-wrapper"><span class="elementor-button-text"><?php _e('Load More', 'ippi'); ?></span></span></a>
                </div>
            <?php } ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </div>
<?php } ?>
<!--========== HTML CODING END============-->
<style>
    .ippi-rr-load-more-btn {
        text-align: center !important;
        display: block;
    }

    a.ippi-btn-hover-black-left {
        /* border: 2px solid #000000; */
        /* padding: 13px 15px 13px 15px; */
        font: normal normal 500 20px/24px Montserrat;
        letter-spacing: 0px;
        color: #000;
        margin: 0 auto;
        margin-top: 20px;
    }
</style>

<script>
    function load_recent_reports(e) {
        var dpage = jQuery(e).attr('data-page');
        var dpageper = jQuery(e).attr('data-post_per_page');
        var dmaxpages = jQuery(e).attr('data-maxpages');
        var col_count = jQuery(e).attr('data-col_count');
        var tax_id = jQuery(e).data('tax-id');
        console.log(dpage, dpageper, dmaxpages);
        dpage = parseInt(dpage) + 1;
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
            dataType: "json", // add data type
            data: {
                action: 'get_ajax_reports',
                post_per_page: dpageper,
                paged: dpage,
                // tax_id: $term_id
                totle_page: dmaxpages,
            },
            success: function(response) {

                // console.log(response.html);
                jQuery(e).attr('data-page', dpage);
                jQuery('.ippi-recent-reports').append(response.html);
                if (dmaxpages == dpage) {
                    jQuery(e).hide();
                }
            }
            
        });

    }
</script>