<?php
$section_heading = $settings['section_heading'];
$selected_related_posts = $settings['selected_related_posts'];
$related_posts = get_field($selected_related_posts, get_the_ID());
$post_id = get_the_ID();
$query = [];
if (!$related_posts) {
    $post_type = '';
    if (!empty($selected_related_posts)) {
        if ($selected_related_posts == 'related_programs') {
            $post_type = array('program', 'experts');
        } else if ($selected_related_posts == 'related_projects') {
            $post_type = 'projects';
        } else if ($selected_related_posts == 'related_experts') {
            $post_type = 'experts';
        } else if ($selected_related_posts == 'related_content') {
            $post_type = array('program', 'projects');
        }
    } else {
        $post_type = 'program';
        $section_heading = 'Related Programs';
    }
    $args = array(
        'post_status' => 'publish',
        'post_type' => $post_type,
        'posts_per_page' => 3,
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

    $related_posts = get_posts($args);
}


//echo '<pre>';
//print_r($related_posts);
//echo '</pre>';
?>
<div class="ippi-related-posts">
    <div class="ippi-related-posts-wrapper">
        <div class="ippi-related-posts-heading">
            <h2 class="ippi-related-posts-title"><?php _e($section_heading, 'ippi'); ?></h2>
        </div>
        <div class="ippi-related-posts-lists-wrapper">
            <ul class="ippi-related-posts-lists">
                <?php
                $count = 1;
               foreach ($related_posts as $post) {
                    $post_title = $post->post_title;
                    $post_link = get_permalink($post->ID);

                    if($post_title){
                        if ($count <= 3) {
                            ?>
                            <li class="ippi-related-posts-item test">
                                <a href="<?php echo $post_link; ?>">
                                    <?php _e($post_title, 'ippi'); ?>
                                </a>
                            </li>
                            <?php
                        }
                    }else {
                        $post_title = get_the_title($post);
                        $post_link = get_permalink($post);
                        if ($count <= 3) {
                            ?>
                            <li class="ippi-related-posts-item test">
                                <a href="<?php echo $post_link; ?>">
                                    <?php _e($post_title, 'ippi'); ?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    $count++;
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<style>
    h2.ippi-related-posts-title {
        font: normal normal 600 24px/29px Gibson;
        letter-spacing: 0px;
        margin-top: 0;
        color: #000000;
        padding-bottom: 18px;
        border-bottom: 2px solid #000;
        margin-bottom: 34px;
    }

    .ippi-related-posts-item a {
        font: normal normal normal 22px/44px Gibson;
        letter-spacing: 0px;
        color: #000000;
    }

    ul.ippi-related-posts-lists {
        padding: 0;
        list-style: none;
    }

    li.ippi-related-posts-item {
        padding-left: 30px;
        position: relative;
    }

    li.ippi-related-posts-item:before {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        top: 16px;
        bottom: 0;
        left: 0;
        background: #000;
        border-radius: 1000px;
    }
</style>
