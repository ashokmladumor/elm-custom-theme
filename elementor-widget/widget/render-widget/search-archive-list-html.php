<?php

$section_heading = $settings['section_heading'];


$search_term = (get_query_var('s')) ? esc_html__(get_query_var('s')) : '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_status' => 'publish',
    'post_type' => 'any',
    'posts_per_page' => 10,
    'paged' => $paged,
);

if (!empty($search_term)) {
    $args['s'] = $search_term;
}

$search_query = new WP_Query($args);

?>
<!--====== HTML CODING START ========-->
<div class="ippi-search-archive">
    <?php
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post(); ?>
            <div class="ippi-search-archive-item">
                <div class="ippi-search-archive-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) :
                            the_post_thumbnail('medium');
                        else : ?>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/f-6-300x185.png' ?>" alt="<?php esc_html_e(get_the_title()); ?>" />
                        <?php
                        endif;
                        ?>
                    </a>
                </div>
                <div class="ippi-search-archive-content">
                    <div class="ippi-search-archive-title">
                        <?php $post_type = get_post_type(get_the_ID());
                        $post_type_obj = get_post_type_object($post_type);
                        $post_type_name = $post_type_obj->labels->singular_name;
                        $reading_time = get_field('reading_time'); ?>
                        <h3>
                            <span> <?php echo $post_type_name; ?> | </span>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="ippi-search-archive-excerpt"><?php the_excerpt(); ?></div>
                        <ul class="ippi-search-archive-date">
                            <li><?php echo get_the_date(); ?></li>
                            <?php if ($reading_time) : ?>
                                <li><?php _e($reading_time, 'ippi'); ?></li>
                            <?php endif; ?>
                        </ul>
                        <div class="ippi-search-archive-terms">
                            <?php
                            $term_obj = get_the_terms(get_the_ID(), 'topics');
                            if ($term_obj) {
                                foreach ($term_obj as $term) {
                                    $term_id = $term->term_id;
                                    $term_name = $term->name;

                                    echo '<a href="' . get_term_link($term_id) . '">' . $term_name . '</a>';
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<h2>" . __('Sorry no search result found!!!', 'ippi-elementor-child') . "</h2>";
    }

    ?>
    <div class="site-pagination text-center" data-aos="fade-up">
        <?php
        $big = 999999999;
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $search_query->max_num_pages,
            'prev_text' => '<i class="fas fa-chevron-left"></i>',
            'next_text' => '<i class="fas fa-chevron-right"></i>',
        ));
        ?>
    </div>

    <?php

    wp_reset_postdata();
    ?>
</div>

<style>
    .ippi-search-archive .ippi-search-archive-item {
        display: flex;
        padding: 36px 0px;
        border-bottom: 2px solid #EBEBEB;
        margin-right: 40px;
        align-items: flex-start !important;
    }

    .ippi-search-archive .ippi-search-archive-image {
        width: 383px;
    }

    .ippi-search-archive .ippi-search-archive-item .ippi-search-archive-image a img {
        width: 383px;
        height: 254px;
        object-fit: fill;
        max-width: 383px;
    }

    .ippi-search-archive .ippi-search-archive-title {
        padding-left: 40px;
    }

    .ippi-search-archive .ippi-search-archive-title h3 {
        font: normal normal 600 26px/36px Gibson !important;
        margin-top: 0px;
        margin-bottom: 10px;
    }

    .ippi-search-archive .ippi-search-archive-title h3 span {
        color: #FF1F8E !important;
    }

    .ippi-search-archive .ippi-search-archive-title h3 a {
        color: #000000 !important;
    }

    .ippi-search-archive .ippi-search-archive-excerpt {
        font: normal normal normal 22px/34px Gibson;
        letter-spacing: 0.44px;
        color: #535353;
        text-overflow: ellipsis;
        overflow: hidden;
        display: -webkit-box !important;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
    }

    .ippi-search-archive .ippi-search-archive-date {
        display: flex;
        padding-left: 15px;
        padding-top: 10px;
    }

    .ippi-search-archive .ippi-search-archive-date li {
        font: normal normal normal 18px/22px Gibson;
        letter-spacing: 0.36px;
        color: #FF1F8E;
        padding-right: 30px;
    }

    .ippi-search-archive .ippi-search-archive-terms {
        margin-top: 30px;
    }

    .ippi-search-archive .ippi-search-archive-terms a {
        padding: 12px 18px;
        border: 2px solid #000;
        font: normal normal normal 16px/35px Gibson;
        letter-spacing: 0.4px;
        color: #000000;
        margin-right: 15px;
        border-radius: 38px;
    }

    .ippi-search-archive .ippi-search-archive-terms a {
        padding: 0px 22px !important;
        margin-bottom: 15px;
    }

    .ippi-search-archive-element .ippi-search-archive-terms {
        display: flex;
        flex-wrap: wrap;
    }

    .ippi-search-archive-element .site-pagination.text-center {
        display: none;
    }

    .ippi-search-archive .site-pagination {
        text-align: center;
        margin-top: 16px !important;
    }
</style>