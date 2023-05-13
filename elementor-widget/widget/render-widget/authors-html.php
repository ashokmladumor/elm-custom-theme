<?php

$section_heading = (isset($settings['section_heading'])) ? $settings['section_heading'] : '' ;
$authors = get_field('authors');
$total_authors = ($authors) ? count($authors) : '';

?>
<!--====== HTML CODING START ========-->
<div class="ippi-authors">
    <?php
    //if authors are more than 4 then display accordin 
    if ($total_authors >= 4) {  ?>
        <div class="accordion-title js-accordion-title">
            <h4><?php _e($section_heading, 'ippi'); ?></h4>
        </div>
        <div class="accordion-content">
            <?php
            if ($authors) :
                foreach ($authors as $author) :
                    $designation = get_field('designation', $author);
                    $twitter = get_field('twitter', $author);
                    $linkedin = get_field('linkedin', $author);
                    $email = get_field('email', $author);
                    $google = get_field('google', $author); ?>
                    <div class="accordian-container">

                        <div class="thumbnail">
                            <a href="!#">
                                    <?php
                                    if (has_post_thumbnail($author)) :
                                        echo get_the_post_thumbnail($author, 'thumbnail');
                                else :
                                    echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/expert-150x150.png" alt="' . get_the_title($author) . '">';
                                endif;
                                ?>
                            </a>
                        </div>

                        <div class="middle">
                            <a href="!#">
                                <h3 class="title"><?php echo get_the_title($author); ?></h3>
                            </a>
                            <?php if ($designation) : ?>
                                <div class="designation"><?php _e($designation, 'ippi'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="social">
                            <ul class="social-inner">
                                <?php if ($twitter) : ?>
                                    <li>
                                        <a href="<?php echo $twitter; ?>" target="_blank"><i class="eicon-twitter"></i></a>
                                    </li>
                                <?php endif;

                                if ($twitter) : ?>
                                    <li>
                                        <a href="<?php echo $linkedin; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                <?php endif;

                                if ($email) : ?>
                                    <li>
                                        <a href="mailto:<?php echo $email; ?>" target="_blank"><i class="eicon-envelope"></i></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                        <?php
                endforeach;
            endif;
            ?>
        </div>
        <?php
    }else{ ?>
        <div class="accordion-title">
        <h4><?php _e($section_heading, 'ippi'); ?></h4>
    </div>
    <div class="accordion-contents">
        <?php
        if ($authors) :
            foreach ($authors as $author) :
                $designation = get_field('designation', $author);
                $twitter = get_field('twitter', $author);
                $linkedin = get_field('linkedin', $author);
                $email = get_field('email', $author);
                $google = get_field('google', $author); ?>
                <div class="accordian-container">

                    <div class="thumbnail">
                        <a href="!#">
                                <?php
                                if (has_post_thumbnail($author)) :
                                    echo get_the_post_thumbnail($author, 'thumbnail');
                            else :
                                echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/expert-150x150.png" alt="' . get_the_title($author) . '">';
                            endif;
                            ?>
                        </a>
                    </div>

                    <div class="middle">
                        <a href="!#">
                            <h3 class="title"><?php echo get_the_title($author); ?></h3>
                        </a>
                        <?php if ($designation) : ?>
                            <div class="designation"><?php _e($designation, 'ippi'); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="social">
                        <ul class="social-inner">
                            <?php if ($twitter) : ?>
                                <li>
                                    <a href="<?php echo $twitter; ?>" target="_blank"><i class="eicon-twitter"></i></a>
                                </li>
                            <?php endif;

                            if ($twitter) : ?>
                                <li>
                                    <a href="<?php echo $linkedin; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            <?php endif;

                            if ($email) : ?>
                                <li>
                                    <a href="mailto:<?php echo $email; ?>" target="_blank"><i class="eicon-envelope"></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                    <?php
            endforeach;
        endif;
        ?>
    </div>
   <?php  }
    ?>

    
</div>

<script>
    //accordian
    jQuery(".accordion-content:not(:first-of-type)").css("display", "none");
    jQuery(".js-accordion-title").click(function() {
        jQuery(".open").not(this).removeClass("open").next().slideUp(300);
        jQuery(this).toggleClass("open").next().slideToggle(300);
    });
</script>