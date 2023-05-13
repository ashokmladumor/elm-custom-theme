<?php

/**
 * Theme functions and definitions
 *
 * @package IppiElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function ippi_elementor_child_enqueue_scripts()
{
    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [
            'hello-elementor-theme-style',
        ],
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'ippi_elementor_child_enqueue_scripts', 20);


/**
 * Load custom css and scripts for front-end and back-end
 *
 * @return void
 */
function ippi_custom_enqueue_scripts()
{
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/custom-style.css');
    wp_enqueue_style('custom-style-one', get_stylesheet_directory_uri() . '/assets/css/custom-style-1.css');
    wp_enqueue_style('custom-style-two', get_stylesheet_directory_uri() . '/assets/css/custom-style-2.css');
    wp_enqueue_style('custom-style-three', get_stylesheet_directory_uri() . '/assets/css/custom-style-3.css');
    wp_enqueue_style('font-family', get_stylesheet_directory_uri() . '/assets/css/font-family.css');
    wp_enqueue_style('hebrew-css', get_stylesheet_directory_uri() . '/assets/css/custom-style-he.css');


    wp_enqueue_style('carousel-min-css', get_stylesheet_directory_uri() . '/assets/css/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_style('owlcarousel-css', get_stylesheet_directory_uri() . '/assets/css/owlcarousel/assets/owl.theme.default.min.css');

    wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/assets/css/slick/slick.css');
    wp_enqueue_style('slick-theme-css', get_stylesheet_directory_uri() . '/assets/css/slick/slick-theme.scss');

    wp_enqueue_script('ippi-custom-js', get_stylesheet_directory_uri() . '/assets/js/ippi-custom.js');
    wp_enqueue_script('ippi-smoothscroll-js', get_stylesheet_directory_uri() . '/assets/js/SmoothScroll.js');

    wp_enqueue_script('carousel-script', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.js', array(), false, true);
    wp_enqueue_script('carousel-min-script', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array(), false, true);

    wp_enqueue_script('slick-script', get_stylesheet_directory_uri() . '/assets/js/slick/slick.js');
    wp_enqueue_script('slick-min-script', get_stylesheet_directory_uri() . '/assets/js/slick/slick.min.js');

    wp_localize_script(
        'loadmore_script',
        'loadmore_params',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('wp_enqueue_scripts', 'ippi_custom_enqueue_scripts', 20);
add_action('admin_enqueue_scripts', 'ippi_custom_enqueue_scripts', 20);


/**
 * create elementor widget
 */
require 'elementor-widget/elementor-widget.php';
require_once 'includes/post_types.php';
require_once 'includes/ajax-functions.php';


// Project shortcode
function project_post($output)
{
    $args = array(
        'post_type' => 'post-project',
        'tax_query' => array(
            array(
                'taxonomy' => 'project-category',
                'field' => 'slug',
                'terms' => 'dossier',
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $output .= "<h2>" . get_the_title() . "</h2>";
            $output .= "<p>" . get_the_excerpt() . "</p>";
            $output .= get_the_post_thumbnail();
        endwhile;
        wp_reset_postdata();
    endif;
    return $output;
}

add_shortcode('project_post', 'project_post');


function change_post_admin_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Publications';
    $submenu['edit.php'][5][0] = 'All Publications';
    $submenu['edit.php'][10][0] = 'Add New';
    $submenu['edit.php'][15][0] = 'Categories';
    $submenu['edit.php'][16][0] = 'Tags';
    $submenu['edit.php'][17][0] = 'Publications Type';
}

add_action('admin_menu', 'change_post_admin_menu_label');


/**
 * Positron functions and definitions
 */
function positronx_set_post_views($post_id)
{
    $count_key = 'wp_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

function positronx_track_post_views($post_id)
{

    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    positronx_set_post_views($post_id);
}

add_action('wp_head', 'positronx_track_post_views');

function get_ajax_posts()
{
    $settings = json_decode(stripcslashes($_POST['settings']));
    $section_heading = json_decode(stripcslashes($_POST['section_heading']));
    $include_term_ids = json_decode(stripcslashes($_POST['include_term_ids']));
    $col_count = (isset($_POST['col_count'])) ? $_POST['col_count'] : 3;
    $show_elements = json_decode(stripcslashes($_POST['show_elements']));
    $current_page = $_POST['current_page'];
    $post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
    $paged = (isset($_POST['paged'])) ? $_POST['paged'] : 1;
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'event',
        'posts_per_page' => $post_per_page,
        'fields' => 'ids',
        'paged' => $paged
    );
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

    if ($show_elements == 'upcoming') {
        $args['meta_query'] = array(
            array(
                'key' => 'event_date',
                'value' => date('Ymd'),
                'compare' => '>',
                'type' => 'NUMERIC'
            )
        );
    } else if ($show_elements == 'past-events') {
        $args['meta_query'] = array(

            array(
                'key' => 'event_date',
                'value' => date('Ymd'),
                'compare' => '<',
                'type' => 'NUMERIC'
            )
        );
    }

    $the_query = new WP_Query($args);
    $return_str = '';

    if ($the_query->have_posts()) :

        while ($the_query->have_posts()) : $the_query->the_post();
            $post = get_post();
            $id = get_the_ID();
            $image = get_the_post_thumbnail($post, 'full');
            $terms = get_the_terms(get_the_ID(), 'event_types');
            $return_str .= '<div class="ippi-grid-col-1/' . $col_count . '  ippi-event-content-item">';
            $return_str .= '<a href="' . get_the_permalink() . '">';
            $return_str .= '<div class="ippi-event-content-item-wrapper">';
            $return_str .= '<div class="ippi-event-content-item-image">';
            $return_str .= $image;
            $return_str .= '<br><span class="ippi-event-content-item-content-type">';
            if ($terms) {
                foreach ($terms as $term) {
                    $return_str .= $term->name . ' • ';
                }
            }
            $return_str .= get_field('event_date', get_the_ID());
            $return_str .= '</span>';
            $return_str .= '</div>';
            $return_str .= '<div class="ippi-event-content-item-content-area">';
            $return_str .= '<div class="ippi-event-content-item-heading">';
            $return_str .= '<h3 class="ippi-event-content-item-title">';
            if ($terms) {
                foreach ($terms as $term) {
                    $return_str .= $term->name . '|';
                }
            }
            $return_str .= '<span class="ippi-event-content-item-title-main">' . get_the_title() . '</span>';
            $return_str .= '</h3>';
            $return_str .= '</div>';
            $return_str .= '<div class="ippi-event-content-item-description">';
            $return_str .= '<p>' . get_the_excerpt() . '</p>';
            $return_str .= '</div>';
            $return_str .= '<div class="ippi-event-content-item-details">';
            $return_str .= '<span class="ippi-event-content-item-date">';
            $return_str .= get_the_date('j F Y') . ' - ';
            $return_str .= get_the_time();
            $return_str .= '</span>';
            $return_str .= '<span class="ippi-event-content-item-view-count">';
            //$return_str .= '<p>' . get_the_time() . '</p>';
            $return_str .= '</span>';
            $return_str .= '</div>';
            $return_str .= '</div>';
            $return_str .= '</div>';
            $return_str .= '</a>';
            $return_str .= '</div>';
        endwhile;
        wp_reset_postdata();

    endif;


    echo $return_str;

    wp_die();
}

add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');


function get_ajax_publication_posts()
{
    $section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '';
    //$selected_posts = (isset($settings['selected_posts'])) ? $settings['selected_posts'] : '';
    $title = (isset($settings['title'])) ? $settings['title'] : '';
    $link = (isset($settings['link'])) ? $settings['link'] : '';
    $post_per_page = (isset($settings['post_per_page'])) ? $settings['post_per_page'] : 6;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $col_count = (isset($_POST['col_count'])) ? $_POST['col_count'] : 3;
    $selected_posts = (isset($_POST['selected_posts'])) ? $_POST['selected_posts'] : 'dossier';
    $args = array(
        'post_status' => 'publish',
        'post_type' => $selected_posts,
        'posts_per_page' => $post_per_page,
        'fields' => 'ids',
        'paged' => $paged
    );


    $my_query = new WP_Query($args); ?>
    <div class="ippi-expert_single-content">
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
                ?>
                    <div class="ippi-grid-col-1/<?php echo $col_count; ?>  ippi-expert_single-content-item">
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
                                            <span class="ippi-expert_single-content-item-content-type"><?php echo get_post_type($id) . ' | '; ?></span>
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
        </div>
        <?php wp_reset_postdata(); ?>
    </div>

<?php wp_die();
}

add_action('wp_ajax_get_ajax_publication_posts', 'get_ajax_publication_posts');
add_action('wp_ajax_nopriv_get_ajax_publication_posts', 'get_ajax_publication_posts');


function my_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyAHlDlsKr-r1QnEji2Jmt-NsmdPvTKDuPU';
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function ippi_image_credit_popup()
{
?>
    <div id="ippi-image-credit-popup" class="ippi-credit-popup">
        <div class="ippi-credit-popup-wrapper">
            <div class="ippi-credit-popup-container">
                <div class="ippi-credit-popup-content">
                    <button class="ippi-credit-popup-close" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon-black.svg">

                    </button>
                    <div class="ippi-credit-popup-heading">
                        <h3 class="ippi-credit-popup-title">Image Credit: Natalie Oralio</h3>
                        <p class="ippi-credit-popup-description">“A banner with the words” Refugees welcome “hangs on
                            Madrid City Hall.”
                            Illustration: Photo by Maria Teneva, unsplash
                            License: Public Domain
                        </p>
                        <a class="ippi-credit-popup-link" href="">Link to source >></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function() {
            jQuery('.ippi-credit-popup-close').click(function() {
                jQuery('.ippi-credit-popup').removeClass('active');
            });
        });
    </script>
<?php

}

add_action('wp_footer', 'ippi_image_credit_popup');

/**
 * Get short HTML, keeping specific tags.
 *
 * @param  string  $string     The initial string to be truncated.
 * @param  integer $max_len    The maximum number of chars for the returned string.
 * @param  string  $end_string Trailing string.
 * @param  string  $allow_tags Preserve HTML tags.
 * @param  bool    $break      Break the last word to a fixed length (defaults to false).
 * @return string
 */
function get_short_html($string, $max_len = 80, $end_string = '...', $allow_tags = '<a><b><strong><em><i><br></br><p>', $break = false)
{
    if (empty($string) || mb_strlen($string) <= $max_len) {
        return $string;
    }

    // Prepare the string for the match.
    $string = strip_shortcodes($string);
    $string = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $string); // phpcs:ignore
    $string = preg_replace('/\>/i', '> ', $string);
    $string = preg_replace('/\</i', ' <', $string);
    $string = preg_replace('/[\x00-\x1F\x7F]/u', '', $string);
    $string = str_replace(' ', ' ', $string);
    $string = preg_replace('/\s+/', ' ', $string);
    $string = preg_replace('/\s\s+/', ' ', trim(strip_tags($string, $allow_tags)));
    $string = html_entity_decode($string);

    // Check for HTML tags and plain text.
    $words_tags = preg_split('/(<[^>]*[^\/]>)/i', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    $current_len = 0;
    $collection = [];
    $opened_tags = [];
    if (!empty($words_tags)) {
        foreach ($words_tags as $item) {
            if ($current_len >= $max_len) {
                // No need to continue.
                break;
            }
            if (substr_count($item, '<') && substr_count($item, '>')) {
                // This is a tag, let's collect it.
                $collection[] = $item;
                if (substr_count($item, '</')) {
                    // This is an ending tag, let's remove the opened one.
                    array_pop($opened_tags);
                } elseif (substr_count($item, '/>')) {
                    // This is a self-closed tag, nothing to do.
                    continue;
                } else {
                    // This is an opening tag, let's add it to the opened list.
                    $t = explode(' ', $item);
                    array_push($opened_tags, substr($t[0], 1));
                }
            } else {
                // This is a plain text, let's assess the length and maybe collect it.
                $words = preg_split('/\s/i', $item, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                if (!empty($words)) {
                    foreach ($words as $word) {
                        // Add + 1 as spaces count too.
                        $new_lenght = $current_len + mb_strlen($word) + 1;
                        if ($new_lenght <= $max_len) {
                            $collection[] = $word . ' ';
                        } else {
                            if (true === $break) {
                                $diff = $max_len - $new_lenght - 1;
                                $collection[] = substr($word, 0, $diff) . ' ';
                            }
                        }
                        $current_len = $new_lenght;
                        if ($current_len >= $max_len) {
                            break;
                        }
                    }
                }
            }
        }
    }

    $string = implode('', $collection);
    if (!empty($opened_tags)) {
        // There were some HTML tags opened that need to be closed.
        array_reverse($opened_tags);
        foreach ($opened_tags as $tag) {
            $string .= '</' . $tag;
        }
    }

    // One final round of preparing the returned string.
    $string = trim($string);
    $string = preg_replace('/<[^\/>][^>]*><\/[^>]+>/', '', $string);
    $string = preg_replace('/(\s+\<\/+)+/', '</', $string);
    $string = preg_replace('/(\s+\,+)+/', ',', $string);
    $string = preg_replace('/(\s+\.+)+/', '.', $string);

    // Maybe append the custom ending to the trimmed string.
    $string .= (!empty($end_string)) ? ' ' . $end_string : '';

    return $string;
}


function ippi_publication_filter()
{

    $form_data = json_decode(stripslashes($_POST['form']));
    $page = $_POST['page'];
    $issue_areas = [];
    $topics = [];
    $regions = [];
    $countries = [];
    $post_type = [];
    $event_types = [];
    $authors = [];
    $year = '';
    $program = [];
    $projects = [];

    foreach ($form_data as $data) {
        switch ($data->name) {
            case "issue_areas":
                $issue_areas[] = $data->value;
                break;
            case "topics":
                $topics[] = $data->value;
                break;
            case "regions":
                $regions[] = $data->value;
                break;
            case "countries":
                $countries[] = $data->value;
                break;
            case "post_type":
                $post_type[] = $data->value;
                break;
            case "event_types":
                $event_types[] = $data->value;
                break;
            case "authors":
                $authors[] = $data->value;
                break;
            case "program":
                $program[] = $data->value;
                break;
            case "projects":
                $projects[] = $data->value;
                break;
            case "year":
                $year = $data->value;
                break;
            default:
        }
    }

    // echo '<pre>11111---';
    // print_r($issue_areas);
    // print_r($topics);
    // print_r($regions);
    //print_r($post_type);

    if (!$post_type) {
        $post_type = array('post', 'backgrounder', 'fellowship', 'projects', 'program', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'experts');
    }
    if ($program || $projects  || $topics || $authors) {
        $post_type = array('post');
    }

    //print_r($post_type);
    //print_r($authors);
    // print_r($year);
    // print_r($program);
    //print_r($projects);
    // echo '</pre>';
    $date_query = [
        [
            'year'  => $year,
        ]
    ];
    $args = array(
        // 'fields' => 'ids',
        'post_status' => 'publish',
        'post_type' => $post_type,
        'posts_per_page' => 10,
        'paged' => $page + 1,
        // 'author__in' => $authors,
        //'post__in' => array($program, $projects),
        'date_query' => $date_query,
        'tax_query' => array(
            'relation' => 'OR',
        ),
        'meta_query' => array(
            'relation' => 'OR',

        ),
    );
    foreach ($program as $id) {
        $args['meta_query'][] = array(
            'key' => 'related_programs',
            'value' => $id,
            'compare' => 'LIKE',
        );
    }

    foreach ($projects as $id) {
        $args['meta_query'][] = array(
            'key' => 'related_projects',
            'value' => $id,
            'compare' => 'LIKE',
        );
    }

    foreach ($authors as $id) {
        $args['meta_query'][] = array(
            'key' => 'authors',
            'value' => $id,
            'compare' => 'LIKE',
        );
    }
    // foreach( $issue_areas as $id){
    //     $args['tax_query'][] = array(
    //         'taxonomy' => 'issue_areas',
    //         'field' => 'id',
    //         'terms' => $issue_areas,
    //     );
    // }

    foreach ($topics as $id) {
        $args['tax_query'][] = array(
            'taxonomy' => 'topics',
            'field' => 'id',
            'terms' => $topics,
        );
    }

    // foreach( $regions as $id){
    //     $args['tax_query'][] = array(
    //         'taxonomy' => 'regions',
    //         'field' => 'id',
    //         'terms' => $regions,
    //     );
    // }

    // foreach( $countries as $id){
    //     $args['tax_query'][] = array(
    //         'taxonomy' => 'countries',
    //         'field' => 'id',
    //         'terms' => $countries,
    //     );
    // }
    if (count($issue_areas) > 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'issue_areas',
            'field' => 'id',
            'terms' => $issue_areas,
        );
    }

    if (count($event_types) > 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'event_types',
            'field' => 'id',
            'terms' => $event_types,
        );
    }
    // if (count($topics) > 0) {
    //     $args['tax_query'][] = array(
    //         'taxonomy' => 'topics',
    //         'field' => 'id',
    //         'terms' => $topics,
    //     );
    // }
    if (count($regions) > 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'regions',
            'field' => 'id',
            'terms' => $regions,
        );
    }
    if (count($countries) > 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'countries',
            'field' => 'id',
            'terms' => $countries,
        );
    }


    $posts = new WP_Query($args);
    // echo '++++++<pre>';
    // print_r($args);
    // echo '</pre>+++++++';

    // echo '________________<pre>';
    // print_r($posts);
    // echo '</pre>________';
    // die;

    $total_post = $posts->found_posts;
    $max_num_pages = $posts->max_num_pages;

    $html = '';
    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post();

            $html .= '<div class="ippi-publication-filter-item">';
            $html .= '<div class="ippi-publication-filter-item-image">';
            $html .= '<a href=" ' . get_the_permalink() . '">';

            if (has_post_thumbnail()) :
                $html .=  get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            else :
                $html .= '<img src="' . get_stylesheet_directory_uri() . '/assets/images/no-image.png" alt=" ' . esc_html(get_the_title()) . ' " />';

            endif;

            $html .= '</a>';
            $html .= '</div>';
            $html .= '<div class="ippi-publication-filter-item-content">';
            $html .= '<div class="ippi-publication-filter-item-title">';
            $post_type = get_post_type(get_the_ID());
            $post_type_obj = get_post_type_object($post_type);
            $post_type_name = $post_type_obj->labels->singular_name;
            $reading_time = get_field('reading_time');
            $html .= '<h3>';
            $html .= '<span>' . $post_type_name . ' | </span>';
            $html .= '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
            $html .= '</h3>';
            $html .= '<div class="ippi-publication-filter-item-excerpt">' . get_the_excerpt() . '</div>';
            $html .= '<ul class="ippi-publication-filter-item-date">';
            $html .= '<li>' . get_the_date() . '</li>';
            if ($reading_time) :
                $html .= '<li>' . $reading_time . '</li>';
            endif;
            $html .= '</ul>';
            $html .= '<div class="ippi-publication-filter-item-terms">';

            $term_obj = get_the_terms(get_the_ID(), 'topics');
            if ($term_obj) {
                foreach ($term_obj as $term) {
                    $term_id = $term->term_id;
                    $term_name = $term->name;

                    $html .= '<a class="ippi-btn-hover-black-left" href="' . get_term_link($term_id) . '">' . $term_name . '</a>';
                }
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
    } else {
        $html .= '<div class="ippi-empty-error">';
        $html .= '<p>Data is not found please reset filters.!!!</p>';
        $html .= '</div>';
    }
    wp_reset_postdata();

    $response = array('status' => 'success', 'html' => $html, 'next_page' => $page + 1, 'max_page' => $max_num_pages);

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_ippi_publication_filter', 'ippi_publication_filter');
add_action('wp_ajax_nopriv_ippi_publication_filter', 'ippi_publication_filter');



function print_arr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
