<?php
add_action( 'admin_menu', 'ig_testimonials_add_admin_menu' );
add_action( 'admin_init', 'ig_testimonials_settings_init' );


function ig_testimonials_add_admin_menu(  ) {

    add_submenu_page( 'edit.php?post_type=testimonial', 'IG Testimonials', 'Settings', 'manage_options', 'ig_testimonials', 'ig_testimonials_options_page' );

}


function ig_testimonials_settings_init(  ) {

    register_setting( 'pluginPage', 'ig_testimonials_settings' );

    add_settings_section(
        'ig_testimonials_pluginPage_section',
        __( 'General Settings', 'ig-testimonials' ),
        'ig_testimonials_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'ig_testimonials_checkbox_disable_script_style',
        __( 'Disable carousel script and style', 'ig-testimonials' ),
        'ig_testimonials_checkbox_disable_script_style_render',
        'pluginPage',
        'ig_testimonials_pluginPage_section'
    );


}


function ig_testimonials_checkbox_disable_script_style_render(  ) {

    $options = get_option( 'ig_testimonials_settings' );
    ?>
    <input type='checkbox' name='ig_testimonials_settings[ig_testimonials_checkbox_disable_script_style]' <?php checked( isset($options['ig_testimonials_checkbox_disable_script_style']), 1 ); ?> value='1'>
    <?php esc_html_e('If your theme use the same carousel you can disable it')?>
    <?php

}


function ig_testimonials_settings_section_callback(  ) {

    echo __( 'Configure your IG Testimonials settings', 'ig-testimonials' );

}


function ig_testimonials_options_page(  ) {

    ?>
<div class="wrap about-wrap ig-testimonials">
    <form action='options.php' method='post'>

        <h2>IG Testimonials</h2>

        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>

    </form>
<hr>
    <div class="feature-section col two-col">
         <div class="col">
            <h3>
                <?php echo __('Getting Started', 'ig-testimonials') ?>
             </h3>
            <p>
                <?php echo __('Learn more about IG Testimonials plugin, visit our website to read the plugin documentation.', 'ig-testimonials') ?>
            </p>
            <a href="http://www.iograficathemes.com/documentation/ig-testimonials/" class="button">
                <?php esc_html_e( 'Read the documentation', 'ig-testimonials' ); ?>
            </a>

            <h3>
                <?php esc_html_e( 'Can i contribute?', 'ig-testimonials' ); ?>
            </h3>
            <p>
                <?php esc_html_e( 'Would you like to translate the plugin into your language? Send us your language file and it will be included in the next plugin release.', 'igname' ); ?>
            </p>
            <a href="http://www.iograficathemes.com/document/make-a-translation/" class="button">
                <?php esc_html_e( 'Read how to make a translation', 'ig-testimonials' ); ?>
            </a>
        </div>
        <div class="col">
            <h3>
                <?php esc_html_e( 'Can\'t find a feature?', 'ig-testimonials' ); ?>
            </h3>
            <p>
                <?php esc_html_e( 'Please suggest and vote on ideas / feature requests at the feedback forum.', 'ig-testimonials' ); ?>
            </p>
            <a href="https://iograficathemes.uservoice.com" class="button">
                <?php esc_html_e( 'Submit your feedback', 'ig-testimonials' ); ?>
            </a>

            <h3>
                <?php esc_html_e( 'Do you like the plugin?', 'ig-testimonials' ); ?>
            </h3>
            <p>
                <?php esc_html_e( 'Why not leave a review on WordPress.org? We\'d really appreciate it!', 'ig-testimonials' ); ?>
            </p>
            <a href="https://wordpress.org/support/view/plugin-reviews/ig-testimonials" class="button">
                <?php esc_html_e( 'Submit your review', 'ig-testimonials' ); ?>
            </a>
    </div>
</div>
<?php
}

?>
