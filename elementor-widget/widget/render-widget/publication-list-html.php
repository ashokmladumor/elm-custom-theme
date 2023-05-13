<?php
$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
$section_heading_toggle = $settings['section_heading_toggle'];
$selected_posts = (isset($settings['selected_posts'])) ? $settings['selected_posts'] : '';
$title = (isset($settings['title'])) ? $settings['title'] : '';
$link = (isset($settings['link'])) ? $settings['link'] : '';
$col_count = $settings['col_count'];
$post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$show_load_more = $settings['loadmore_toggle'];
$post_types = get_post_type(get_the_ID());
$post_id = get_the_ID();
if($post_types == 'experts' ){
    $args = array(
        // 'fields' => 'ids',
         'post_status' => 'publish',
         'post_type' => $selected_posts,
         'posts_per_page' => $post_per_page,
         'paged' => $paged,
         'suppress_filters' => false,
         'meta_query' => array(
             'relation' => 'AND',
             array(
                 'key' => 'related_experts',
                 'value' => $post_id,
                 'compare' => 'LIKE',
             )
         ),
     );

}else{
    $args = array(
        'post_status' => 'publish',
      'post_type' => $selected_posts,
         'posts_per_page' => $post_per_page,
          'paged' => $paged,
         'suppress_filters' => false,
         
     );
}

$my_query = new WP_Query($args);
//echo '<pre>';
//print_r($my_query);
//echo '</pre>';
$total_post = $my_query->found_posts;
$max_num_pages = $my_query->max_num_pages;

if ($show_load_more) {
    $args['posts_per_page'] = 6;
    $args['paged'] = $paged;
}
?>
<!--====== HTML CODING START ========-->
<div class="ippi-expert_single-content">
    <div class="ippi-container">
        <div class="ippi-view-all-section">
            <h2 class="ippi-expert_single-content-section-title <?php echo ($section_heading_toggle == 'yes') ? (!empty($title) ? ' ippi-border-b-2' : '') : ''; ?>">
                <?php _e($section_heading, 'ippi'); ?>
            </h2>
            <div class="ippi-view-link-title">
                <?php if (!empty($settings['link']['url'])) {
                    $this->add_link_attributes('link', $settings['link']);
                } ?>
                <a class="ippi-view-link-tag" href="<?php echo $link['url']; ?>" <?php echo ($link['is_external']) ? 'target="_blank"' : '' ?>>
                    <span class="ippi-view-link-title"> <?php _e($title, 'ippi'); ?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="ippi-expert_single-content-wrapper ippi-container ippi-tab-publication-content">
        <div class="ippi-publication-list-tab-content ippi-grid-row">
            <?php
            while ($my_query->have_posts()) : $my_query->the_post();
                $post = get_post();
                $id = get_the_ID();
                $image = get_the_post_thumbnail_url($post, 'full');
                if (!$image) {
                    $image = get_stylesheet_directory_uri() . '/assets/images/no-image.png';
                }
                $item_icon = '';
                if (get_post_type($id) == 'video') {
                    $item_icon = get_stylesheet_directory_uri() . '/assets/images/video-icon.svg';
                } else if (get_post_type($id) == 'podcast') {
                    $item_icon = get_stylesheet_directory_uri() . '/assets/images/podcast-icon.svg';
                }
                $postType = get_post_type_object(get_post_type($post));
            ?>
                <div class="ippi-grid-col-1/<?php echo $col_count; ?> ippi-expert_single-content-item">
                    <a href="<?php echo get_the_permalink() ?>">
                        <div class="ippi-expert_single-content-item-wrapper">
                            <div class="ippi-expert_single-content-item-image">
                                <img src="<?php echo $image; ?>">
                                <?php if ($item_icon) { ?>
                                    <div class="ippi-expert_single-content-item-icon" style="background-image: url(<?php echo $item_icon; ?>)"></div>
                                <?php } ?>
                            </div>
                            <div class="ippi-expert_single-content-item-content-area ">
                                <div class="ippi-expert_single-content-item-heading">
                                    <h3 class="ippi-expert_single-content-item-title">
                                        <span class="ippi-expert_single-content-item-content-type"><?php _e($postType->labels->name, 'ippi'); ?> <?php _e('|', 'ippi'); ?></span>
                                        <span class="ippi-expert_single-content-item-title-main"> <?php echo get_the_title(); ?> </span>
                                    </h3>
                                </div>
                                <div class="ippi-expert_single-content-item-description">
                                    <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                                </div>
                                <div class="ippi-expert_single-content-item-details">
                                    <span class="ippi-expert_single-content-item-date"> <?php echo get_the_date(); ?></span>
                                    <span class="ippi-expert_single-content-item-view-count"> <?php echo (get_field('reading_time')) ? get_field('reading_time') : '0 Minute'; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            endwhile;
            ?>
        </div>

        <?php if (($max_num_pages > $paged && $show_load_more)) { ?>
            <div class="ippi-publication-load-more">
                <a href="#" class="ippi-btn-hover-black-left" onclick="load_posts_list(event, this);" data-selected_posts="<?php echo $selected_posts; ?>" data-page="1" data-post_per_page="<?php echo $post_per_page; ?>" data-maxpages="<?php echo $max_num_pages; ?>"><span class="elementor-button-content-wrapper "><span class="elementor-button-text"><?php _e('Load More', 'ippi'); ?></span></span></a>

            </div>
        <?php } ?>
    </div>
    <?php wp_reset_postdata(); ?>
</div>
<!--========== HTML CODING END============-->
<style>
    .ippi-border-b-2 {
        display: flex;
        border-bottom: 2px solid #000 !important;
        margin-bottom: 30px;
    }

    .ippi-view-all-section {

        justify-content: space-between;
        width: 100%;
    }

    span.ippi-view-link-title {
        font: normal normal normal 28px/48px Gibson;
        letter-spacing: 0.7px;
        color: #000000;
    }

    .ippi-expert_single-contents h2 {
        margin-bottom: 40px;
    }

    .ippi-expert_single-content {
        display: block;
        padding-top: 15px;
        padding-bottom: 7px;
    }

    .ippi-expert_single-contents .ippi-expert_single-content-item-content-area {
        background: #F5F7F6;
    }

    .ippi-expert_single-content-wrapper {
        position: relative;
    }

    .ippi-expert_single-content-item-wrapper {
        transition: all 0.3s ease-in-out 0s;
        background: #FFFFFF 0% 0% no-repeat padding-box;
    }

    h2.ippi-expert_single-content-section-title {
        margin: 0;
        padding: 0;
        font: normal normal 600 50px/60px Gibson !important;
        letter-spacing: 1px;
        color: #000000;
        margin-bottom: 5px;
    }

    h3.ippi-expert_single-content-item-title {
        font: normal normal 600 20px/28px Gibson;
        letter-spacing: 0.4px;
        margin-bottom: 0px;
        color: #231E1D;
        text-transform: capitalize;
    }


    .ippi-expert_single-content-item-wrapper:hover {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 20px #00000029;
    }

    .ippi-expert_single-content-item-wrapper h3.ippi-expert_single-content-item-title .ippi-expert_single-content-item-title-main {
        text-decoration: underline transparent;
        -webkit-text-underline-position: under;
        -ms-text-underline-position: below;
        text-underline-position: under;
    }

    .ippi-expert_single-content-item-image {
        position: relative;
        max-height: 336px;
        overflow: hidden;
    }

    .ippi-expert_single-content-item-icon {
        height: 75px;
        background-repeat: no-repeat;
        width: 75px;
        background-position: center;
        background-size: 50px;
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #ffffff80;
    }

    /* .ippi-expert_single-content-item-wrapper span.ippi-expert_single-content-item-title-main:hover {
            text-decoration: underline;
            text-decoration-color: #ff1f8e !important;
        } */

    span.ippi-expert_single-content-item-content-type {
        color: #FF1F8E;
        font-size: 30px;
        font-weight: 600;
        line-height: 42px;
        letter-spacing: 0.6px;
    }

    span.ippi-expert_single-content-item-title-main {
        color: #000;
        font-size: 30px;
        font-weight: 600;
        line-height: 40px;
        letter-spacing: 0.6px;
    }

    .ippi-expert_single-contents .ippi-expert_single-content-item-heading h3 span.ippi-expert_single-content-item-title-main:hover {
        text-decoration: underline;
        text-decoration-color: #ff1f8e;
    }

    .ippi-expert_single-content-item-content-area {
        padding: 43px 35px 34px 28px;
    }

    .ippi-expert_single-content-item-wrapper {
        background: #F5F7F6 !important;
    }

    .ippi-expert_single-content-item-description {
        font: normal normal normal 18px/28px Gibson;
        letter-spacing: 0px;
        margin-bottom: 35px;
        color: #535353;
        margin-top: 40px;
    }

    .ippi-expert_single-content-item {
        margin-bottom: 10px;
    }

    .ippi-expert_single-content-item-wrapper {
        height: 100%;
    }

    .ippi-expert_single-content-item-details {
        text-align: left;
        font: normal normal normal 18px/22px Gibson;
        letter-spacing: 0.36px;
        color: #FF1F8E;
        opacity: 1;
        position: relative;
        margin-bottom: 18px;
    }

    .ippi-expert_single-content .ippi-expert_single-content-item-image img {
        max-width: 100%;
        width: 100%;
        object-fit: cover;
        height: 360px;
    }

    span.ippi-expert_single-content-item-date {
        padding-right: 20px;
        position: relative;
    }

    span.ippi-expert_single-content-item-view-count {
        padding-left: 20px;
    }

    span.ippi-expert_single-content-item-date:after {
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

    .ippi-publication-load-more {
        text-align: center;
    }

    a.ippi-publication-post-load-btn.ippi-btn-hover-black-left {
        border: 2px solid #000000;
        padding: 13px 15px 13px 15px;
        font: normal normal 500 20px/24px Montserrat;
        letter-spacing: 0px;
        color: #000;
        margin: 0 auto;
        margin-top: 20px;
        align-items: center;
    }
</style>
<script>
    function load_posts_list(e, el) {
        e.preventDefault();
        var dpage = jQuery(el).attr('data-page');
        var dpageper = jQuery(el).attr('data-post_per_page');
        var dmaxpages = jQuery(el).attr('data-maxpages');
        var dselected_posts = jQuery(el).attr('data-selected_posts');
        console.log(dpage, dpageper, dmaxpages, dselected_posts);
        dpage = parseInt(dpage) + 1;
        jQuery.ajax({
            type: 'POST',
            url: 'https://ippi.fatfish.co.il/wp-admin/admin-ajax.php',
            dataType: "html", // add data type
            data: {
                action: 'get_ajax_publication_posts',
                post_per_page: dpageper,
                paged: dpage,
                totle_page: dmaxpages,
                selected_posts: dselected_posts,
            },
            success: function(response) {
                jQuery(el).attr('data-page', dpage);
                jQuery(el).parents('.ippi-tab-publication-content').first().find('.ippi-publication-list-tab-content').first().append(response);
                console.log(dmaxpages, '==', dpage);
                if (dmaxpages == dpage) {
                    jQuery(el).hide();
                }
            }
        });

    }
</script>