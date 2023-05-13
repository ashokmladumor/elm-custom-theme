<?php
$job_id = $job->ID;
$term_obj_type = get_the_terms( $job_id, 'type' );
$terms_type = join(', ', wp_list_pluck($term_obj_type, 'name'));

$location_to_show = get_field( 'show_location_type', $job_id );
$city = get_field( 'city', $job_id );
$google_location = get_field( 'google_location', $job_id );
$term_obj_countries = get_the_terms( $job_id, 'countries' );
$terms_countries = join(', ', wp_list_pluck($term_obj_countries, 'name'));
$partner_organisation = get_field( 'partner_organisation', $job_id );
$application_link = esc_url( get_field( 'application_link', $job_id ) );


$display_location = "";
if ( '1' == $location_to_show ){
    $display_location = $city;
}elseif ( '2' == $location_to_show ){
    $display_location = $terms_countries;
}elseif ( '3' == $location_to_show ){
    $display_location = $google_location['name'];
}
$program_name = "Sustainability Challenges in Israel";
?>
<div class="accordion-title js-accordion-title">
    <div class='title'> <?php _e($job->post_title, 'ippi'); ?> </div>
    <span class='type'> <strong> <?php _e( 'Type :', 'ippi' ); ?></strong> <?php _e($terms_type,'ippi'); ?></span>
    <span class='location'> <strong><?php _e( 'Location :', 'ippi' ); ?></strong> <?php _e($display_location,'ippi'); ?></span>
    <span class='program'> <strong><?php _e( 'Program :', 'ippi' ); ?></strong><?php _e($program_name, 'ippi');?></span>
    <span class='partner_organization'> <strong><?php _e( 'Partner Organization :', 'ippi' ); ?></strong> <?php _e($partner_organisation, 'ippi'); ?></span>
</div>
<div class="accordion-content">
    <?php echo wpautop( $job->post_content ); ?>

    <?php if($application_link): ?>
        <a class="elementor-post__read-more" href="<?php echo $application_link; ?>" target="_blank"><?php _e( 'Apply', 'ippi-elementor-child' ); ?></a>
    <?php endif; ?>
</div>
<?php