<?php
$section_heading = $settings['section_heading'];
$selected_partners = $settings['selected_partners'];
$current_post = get_post(get_the_ID());
$related_activity = $settings['related_activity'];
$partners = get_field('partners', get_the_ID());
echo '<pre>';
print_r($related_partners);
echo '</pre>';
// $partners = [];
// if($related_partners) {
//     foreach($related_partners as $partner){
//         $partners[] = $partner->ID;
//     }
// }
// $_selected = get_posts(array(
//     'post_type' => 'partner', 
//     'posts_per_page' => -1, 
//     'post_status' => 'publish', 
//     'post__in' => $selected_partners)
// );

$query = [];

if ($selected_partners || $partners) {
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'any',
        'post__in' => $partners ? $partners : (($selected_partners) ? $selected_partners : []),
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => -1,
    );
    if ($recency_and_popularity == 'recency') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } else if ($recency_and_popularity == 'popularity') {
        $args['meta_key'] = 'wp_post_views_count'; // set custom meta key
        $args['orderby'] = 'meta_value_num';
    }

    $query = new WP_Query($args);
    
} else {
    $related_args = array(
        'post_status' => 'publish',
        'post_type' => $related_activity,
        'orderby' => 'date',
        'order' => 'ASC',
        'fields' => 'ids',
        'posts_per_page' => -1,
    );
    $post_ids = get_posts($related_args);

    $partners_list = [];
    foreach ($post_ids as $post_id) {
        $selected_partners = get_field('partners', $post_id);
        if ($selected_partners) {

            foreach ($selected_partners as $exp_id) {
                $partners_list[$exp_id] = $exp_id;
            }
        }
    }


    $args = array(
        'post_status' => 'publish',
        'post_type' => 'partner',
        'post__in' => $partners_list,
        'orderby' => 'date',
        'order' => 'ASC',
    );

    if ($recency_and_popularity == 'recency') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } else if ($recency_and_popularity == 'popularity') {
        $args['meta_key'] = 'wp_post_views_count'; // set custom meta key
        $args['orderby'] = 'meta_value_num';
    }
    $query = new WP_Query($args);
}



// $terms = wp_get_post_terms(get_the_ID(), 'partner');
//$partners = (get_field('partners', get_the_ID())) ?? $_selected;
$rand_id = rand(1, 1000);
if ($query) {
?>
    <div class="ippi-section-partners">
        <div class="ippi-partners">
            <div class="ippi-partners-wrapper">
                <div class="ippi-partners-heading">
                    <h2 class="ippi-partners-title"><?php $section_heading ? _e($section_heading, 'ippi') : _e('Partners', 'ippi'); ?></h2>
                </div>
                <div class="ippi-all-partners ippi-container">
                    <div class="ippi-partners-slick-slider-<?php echo $rand_id; ?> ippi-partners-slick-slider slick-slider" slider-id="<?php echo $rand_id; ?>">
                        <?php

                        while ($query->have_posts()) : $query->the_post();

                            $post = get_post();
                            $id = get_the_ID();
                            $image = get_the_post_thumbnail_url($id, 'full');
                            if ($image) {
                        ?>
                                <div class="ippi-partners-slide ippi-partner-item">
                                    <a href="<?php echo (get_field('email', $id)) ? 'mailto:' . get_field('email', $id) : 'javascript:void(0);'; ?>">
                                        <img src="<?php echo $image; ?>" title="<?php echo get_the_title($id); ?>" alt="<?php echo get_the_title($id); ?>">
                                    </a>
                                </div>
                        <?php
                            }
                        endwhile;

                        ?>
                    </div>
                    <div class="custom_paging">
                        <div class="ippi-partners-slick-prev ippi-partners-slick-prev-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                        <div class="ippi-partners-slick-next ippi-partners-slick-next-<?php echo $rand_id; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/gray-arrow.svg' ?>)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    </script>
<?php

    wp_reset_postdata();
}
