<?php

$section_heading = $settings['section_heading'];
$section_description = $settings['section_description'];


// $issue_areas_terms = ippi_convert_terms_check_box('issue_areas');
//echo '<pre>';
//print_r($issue_areas_terms);
//echo '</pre>';


function ippi_convert_terms_check_box($taxonomy_slug)
{
    $terms = get_terms(
        $taxonomy_slug,
        array(
            'hide_empty' => false,
        )
    );
    $terms_array = [];
    $html = '';
    $html .= '<div class="ippi-filter-checkbox ippi-filter-checkbox-' . $taxonomy_slug . '">';
    foreach ($terms as $term) {
        $terms_array[$term->term_id] = $term->name;
        $html .= '<div>';
        $html .= '<input type="checkbox" class="ippi-for-clear-filter  ippi-filter-field" id="ippi-checkbox-' . $taxonomy_slug . '' . $term->term_id . '"  name="' . $taxonomy_slug . '" value="' . $term->term_id . '">';
        $html .= '<label for="ippi-checkbox-' . $taxonomy_slug . '' . $term->term_id . '">' . $term->name . '</label>';
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}

function ippi_convert_posts_check_box($post_type)
{
    $query = [];

    $args = array(
        'post_status' => 'publish',
        'post_type' => $post_type,
        'fields' => 'ids',
        'suppress_filters' => false,
        'posts_per_page' => -1
    );

    $query = get_posts($args);

    $html = '';
    $html .= '<div class="ippi-filter-checkbox ippi-filter-checkbox-' . $post_type . '">';
    foreach ($query as $id) {
        $html .= '<div>';
        $html .= '<input type="checkbox" class="ippi-for-clear-filter ippi-filter-field" id="ippi-checkbox-' . $post_type . '' . $id . '"  name="' . $post_type . '" value="' . $id . '">';
        $html .= '<label for="ippi-checkbox-' . $post_type . '' . $id . '">' . get_the_title($id) . '</label>';
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}

function ippi_all_post_types_check_box($custom_class)
{
    $post_types = array(
        'backgrounder' => __('backgrounder', 'ippi'),
        'fellowship' => __('fellowship', 'ippi'),
        'projects' => __('projects', 'ippi'),
        'program' => __('program', 'ippi'),
        'event' => __('event', 'ippi'),
        'dossier' => __('dossier', 'ippi'),
        'video' => __('video', 'ippi'),
        'podcast' => __('podcast', 'ippi'),
        'post-report' => __('post-report', 'ippi'),
        'explainer' => __('explainer', 'ippi'),
        'experts' => __('experts', 'ippi'),
        'in_the_news' => __('in_the_news', 'ippi')
    );


    $html = '';
    $html .= '<div class="ippi-filter-checkbox ippi-filter-checkbox-' . $custom_class . '">';
    foreach ($post_types as $post_type => $value) {
        $html .= '<div>';
        $html .= '<input type="checkbox" class="ippi-for-clear-filter ippi-filter-field" id="ippi-checkbox-' . $post_type . '' . $custom_class . '"  name="post_type" value="' . $post_type . '">';
        $html .= '<label for="ippi-checkbox-' . $post_type . '' . $custom_class . '">' . $value . '</label>';
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}

$args = array(
    'post_status' => 'publish',
    //'post_type' => array('post', 'backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer','experts','in_the_news'),
    'post_type' => array('post', 'event'),
    'posts_per_page' => 10,
    'paged' => 1,
);

// echo '<pre>';print_r($args);echo '</pre>';
$posts = new WP_Query($args);
$total_post = $posts->found_posts;
$max_num_pages = $posts->max_num_pages;

?>
<!--====== HTML CODING START ========-->
<div class="ippi-publication-filter">

    <div class="ippi-publication-filter-wrapper">
        <div class="ippi-publication-filter-container">
            <div class="ippi-publication-filter-content">
                <div class="ippi-publication-filter-heading">
                    <h1 class="ippi-publication-filter-title"><?php _e($section_heading, 'ippi') ? $section_heading : get_the_title(); ?></h1>
                </div>
                <div class="ippi-publication-filter-description">
                    <p class="ippi-publication-filter-short-desc"><?php _e($section_description, 'ippi') ? $section_description : '' ?></p>
                </div>
            </div>
            <div class="ippi-publication-filters">

                <div class="ippi-publication-filters-wrapper">
                    <div class="ippi-loader-wrapper">
                        <span class="ippi-loader"></span>
                    </div>
                    <div class="ippi-grid-row ippi-loading">
                        <div class="ippi-grid-col-1/5">
                            <form id="ippi-publication-filters-form" page="1" max-page="<?php echo $max_num_pages; ?>">
                                <div class="ippi-publication-filters-collapse">
                                    <div class="ippi-filters-collapse">
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-issue-area"><?php _e('Issues', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-issue-area" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_terms_check_box('issue_areas'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-topics"><?php _e('Topics', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-topics" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_terms_check_box('topics'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-regions"><?php _e('Regions', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-regions" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_terms_check_box('regions'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-countries"><?php _e('Countries', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-countries" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_terms_check_box('countries'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-event_types"><?php _e('Event Types', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-event_types" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_terms_check_box('event_types'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-authors"><?php _e('Author / Speaker', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-authors" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_posts_check_box('authors'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-authors"><?php _e('Year', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-authors" class="ippi-filters-collapse-tab" style="display: none;">
                                                <div class="ippi-filter-date ippi-filter-date-for-year">
                                                    <div>
                                                        <?php $years = range(1900, strftime("%Y", time())); ?>
                                                        <select id="ippi-filter-date-picker-year" name="year" class="ippi-for-clear-filter ippi-filter-field">
                                                            <option><?php _e('Select Year', 'ippi'); ?></option>
                                                            <?php foreach ($years as $year) : ?>
                                                                <option value="<?php _e($year, 'ippi'); ?>"><?php _e($year, 'ippi'); ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <!-- <input id="ippi-filter-date-picker-year" type="date" name="year" class="ippi-for-clear-filter ippi-filter-field"> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-program"><?php _e('Program', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-program" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_posts_check_box('program'); ?>
                                            </div>
                                        </div>
                                        <div class="ippi-filters-collapse-tab-wrapper">
                                            <a class="ippi-filters-collapse-tab-selector " href="#ippi-filters-collapse-tab-Project"><?php _e('Project', 'ippi'); ?></a>
                                            <div id="ippi-filters-collapse-tab-Project" class="ippi-filters-collapse-tab" style="display: none;">
                                                <?php echo ippi_convert_posts_check_box('projects'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="ippi-publication-filter-clear" style="display: none;">
                                <button class="ippi-filters-clear-button" onclick="clear_all_publications(this);" id="ippi-filters-clear-button"><?php _e('x Clear Filters', 'ippi'); ?></button>
                            </div>
                        </div>
                        <div class="ippi-grid-col-4/5">
                            <div class="ippi-publication-filter-posts">
                                <?php if ($posts->have_posts()) {
                                    while ($posts->have_posts()) {
                                        $posts->the_post(); ?>

                                        <div class="ippi-publication-filter-item">
                                            <div class="ippi-publication-filter-item-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    if (has_post_thumbnail()) :
                                                        the_post_thumbnail('large');
                                                    else : ?>
                                                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/no-image.png' ?>" alt="<?php esc_html_e(get_the_title()); ?>" />
                                                    <?php
                                                    endif;
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="ippi-publication-filter-item-content">
                                                <div class="ippi-publication-filter-item-title">
                                                    <?php $post_type = get_post_type(get_the_ID());
                                                    $post_type_obj = get_post_type_object($post_type);
                                                    $post_type_name = $post_type_obj->labels->singular_name;
                                                    $reading_time = get_field('reading_time'); ?>
                                                    <h3>
                                                        <span> <?php echo $post_type_name; ?>| </span>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="ippi-publication-filter-item-excerpt"><?php the_excerpt(); ?></div>
                                                    <ul class="ippi-publication-filter-item-date">
                                                        <li><?php echo get_the_date(); ?></li>
                                                        <?php if ($reading_time) : ?>
                                                            <li><?php _e($reading_time, 'ippi'); ?></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <div class="ippi-publication-filter-item-terms">
                                                        <?php
                                                        $term_obj = get_the_terms(get_the_ID(), 'topics');
                                                        if ($term_obj) {
                                                            foreach ($term_obj as $term) {
                                                                $term_id = $term->term_id;
                                                                $term_name = $term->name;

                                                                echo '<a class="ippi-btn-hover-black-left" href="' . get_term_link($term_id) . '">' . $term_name . '</a>';
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } ?>

                            </div>
                            <?php if (($max_num_pages > 1)) { ?>
                                <div class="ippi-publication-load-more-wrapper">
                                    <!-- <a href="javascript:void(0);" id="ippi-publication-load-more" class="ippi-btn-hover-black-left" onclick="load_more_publications(this);"><?php _e('Load More', 'ippi'); ?></a> -->
                                    <a href="javascript:void(0);" id="ippi-publication-load-more" onclick="load_more_publications(this);" class="ippi-btn-hover-black-left elementor-button-link elementor-button elementor-size-sm" role="button">
                                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-text"><?php _e('Load More', 'ippi'); ?></span>
                                        </span>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
<style>
    h1.ippi-publication-filter-title {
        font: normal normal 600 90px/110px Gibson;
        letter-spacing: 1.8px;
        color: #000000;
        text-align: center;
        margin-top: 137px;
        margin-bottom: 34px;
    }

    p.ippi-publication-filter-short-desc {
        text-align: center;
        font: normal normal normal 30px/42px Gibson;
        letter-spacing: 0.6px;
        color: #231E1D;
        max-width: 1057px;
        margin: 0 auto 84px;
    }

    .ippi-publication-filter-item {
        display: flex;
        align-items: center;
    }

    .ippi-publication-filter-item-image {
        max-width: 383px;
    }

    .ippi-publication-filter-item-content {
        width: 70%;
    }

    .ippi-publication-filters-wrapper {
        position: relative;
    }

    .ippi-loader-wrapper {
        display: none;
    }

    .ippi-loader-wrapper.active {
        position: absolute;
        top: 0;
        bottom: 0;
        left: -15px;
        right: -15px;
        z-index: 1;
        background: #ffffff80;
        display: block;
    }

    .ippi-bg-blur {
        filter: blur(8px);
        -webkit-filter: blur(8px);
    }

    .ippi-loader {
        width: 100px;
        height: 100px;
        border: 3px solid var(--e-global-color-secondary);
        border-radius: 50%;
        display: inlinef-block;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .ippi-loader::after {
        content: "";
        box-sizing: border-box;
        position: absolute;
        left: 0;
        top: 0;
        background: var(--e-global-color-text);
        width: 20px;
        height: 20px;
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    .ippi-publication-filter .ippi-filters-collapse-tab-wrapper {
        border-top: 2px solid #000000;
        padding-bottom: 0;
    }

    .ippi-publication-filter .ippi-filters-collapse-tab-wrapper a {
        padding-bottom: 23px;
        width: 100%;
        display: flex;
        transition: all 0.3s ease-in;
    }

    .ippi-filters-collapse-tab {
        padding-bottom: 40px;
    }

    .ippi-filters-collapse-tab-wrapper a:hover {
        color: var(--e-global-color-secondary);
    }

    a.ippi-filters-collapse-tab-selector:after {
        content: "";
        position: absolute;
        top: 28px;
        transform: rotate(225deg);
        display: inline-block;
        width: 16px;
        height: 16px;
        border-top: 2px solid #000;
        border-left: 2px solid #000;
        transition: all 250ms ease-in-out;
        border-bottom: none;
        border-right: none;
        right: 15px;
    }

    a.ippi-filters-collapse-tab-selector {
        position: relative;
    }

    a.ippi-filters-collapse-tab-selector:hover:after {
        border-color: #ff1f8e;
    }

    a.ippi-filters-collapse-tab-selector.opened:after {
        transform: rotate(44deg);
    }

    a#ippi-publication-load-more {
        border: 2px solid #000000;
        padding: 13px 55px 13px 55px;
        font: normal normal 500 20px/24px Montserrat;
        letter-spacing: 0px;
        color: #000;
        margin: 0 auto;
        margin-top: 51px;
        align-items: center;
    }

    .ippi-publication-load-more-wrapper {
        display: flex;
    }

    .ippi-publication-filter-item-terms {
        display: flex;
        flex-wrap: wrap;
    }

    .ippi-publication-filter-item-title .ippi-publication-filter-item-terms a {
        margin-bottom: 10px;
        line-height: 30px;
    }

    .ippi-empty-error {
        text-align: center;
        margin-top: 50px;
        font: normal normal normal 30px/48px Gibson;
        letter-spacing: 0.75px;
        color: #000000;
    }
</style>
<script>
    jQuery('.ippi-filters-collapse-tab-selector').click(function(e) {
        e.preventDefault();
        // jQuery(this).attr('href')
        if (jQuery(this).hasClass('opened')) {
            jQuery(this).removeClass("opened").next().slideUp(300);
        } else {
            jQuery(this).addClass("opened").next().slideToggle(300);
        }
        // jQuery(this).toggleClass("opened").next().slideToggle(300);
    });

    jQuery('.ippi-filter-field').change(function(e) {
        e.preventDefault();
        jQuery('.ippi-publication-filter-clear').show();
        jQuery("#ippi-publication-filters-form").attr('page', 0);
        jQuery("#ippi-publication-filters-form").submit();
    });



    function clear_all_publications() {

        jQuery('.ippi-filters-collapse-tab-selector').each(function(i, e) {
            jQuery(e).removeClass("opened").next().slideUp(300);
        });

        jQuery('.ippi-for-clear-filter', "#ippi-publication-filters-form").not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
        jQuery("#ippi-publication-filters-form").attr('page', 0);
        jQuery("#ippi-publication-filters-form").submit();
        jQuery('.ippi-publication-filter-clear').hide();
    }

    function load_more_publications(e) {
        jQuery("#ippi-publication-filters-form").submit();
    }

    jQuery("#ippi-publication-filters-form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        jQuery('.ippi-loading').addClass('ippi-bg-blur');
        jQuery('.ippi-loader-wrapper').addClass('active');
        var current_page = jQuery("#ippi-publication-filters-form").attr('page');
        var max_page = jQuery("#ippi-publication-filters-form").attr('max-page');
        var form = jQuery(this);
        var data = form.serializeArray();
        var JSONData = JSON.stringify(data);

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            dataType: "html",
            data: {
                action: 'ippi_publication_filter',
                form: JSONData,
                page: current_page,
            },
            success: function(response) {
                jQuery('.ippi-loading').removeClass('ippi-bg-blur');
                jQuery('.ippi-loader-wrapper').removeClass('active');
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    if (res.next_page == 1) {
                        jQuery('.ippi-publication-filter-posts').html(res.html);
                    } else if (res.next_page > 1) {
                        jQuery('.ippi-publication-filter-posts').append(res.html);
                    }
                    var next_page = parseInt(current_page) + 1;
                    if (next_page == parseInt(max_page) || res.max_page <= 1) {
                        jQuery('#ippi-publication-load-more').hide();

                    } else {
                        jQuery('#ippi-publication-load-more').show();
                    }
                    jQuery("#ippi-publication-filters-form").attr('page', next_page);
                }
            }
        });
    });
</script>