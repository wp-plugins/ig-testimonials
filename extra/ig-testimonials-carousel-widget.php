<?php
/**
* Add widget class
**/
class ig_testimonials_carousel_widget extends WP_Widget {
/**
* Register widget with WordPress.
**/
function __construct() {
parent::__construct(
'ig_testimonials_carousel_widget', // Base ID
esc_html__('IG Testimonials Carousel', 'ig-testimonials'), // Name
array('description' => esc_html__('Display a carousel with your testimonials', 'ig-testimonials' ),) // Args
);
}
/**
* Front-end display of widget.
*/
public function widget( $args, $instance ) {
        $cat = isset( $instance[ 'testimonial_cat' ]) ? esc_attr( $instance['testimonial_cat'] ) : '';
        $show_image = isset( $instance[ 'show_image' ]) ? esc_attr( $instance['show_image'] ) : '';

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }

?>
<?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
<div class="ig-testimonials-carousel">
    <?php
    if ( empty ( $instance['testimonial_cat'] ) ) {
            $testimonial_query = new WP_Query();
            $testimonial_query->query( array(
    'showposts' => -1,
    'post_status' => 'publish',
    'post_type' => 'testimonial')
    );
    } else {
            $testimonial_query = new WP_Query();
            $testimonial_query->query( array(
    'showposts' => -1,
    'post_status' => 'publish',
    'post_type' => 'testimonial',
    'tax_query' => array(
        array(
        'taxonomy' => 'testimonial-cat',
        'field' => 'id',
        'terms' => array($cat)
        )
    ))
);
    }
            while ($testimonial_query->have_posts()) : $testimonial_query->the_post();

        ?>

            <div id="testimonial-<?php the_ID(); ?>" class="ig-testimonials item">

        <?php if ( $show_image ) : ?>
            <?php if ( has_post_thumbnail()) : ?>
                <div class="image">
                        <?php the_post_thumbnail('ig-testimonials-thumb-medium'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

                <div class="text">
                    <?php the_content();?>
                </div>

            <?php if ( ig_testimonials_get_meta( 'ig_testimonials_name' ) ) : ;?>
                <span class="name">
                    <strong> <?php echo ig_testimonials_get_meta( 'ig_testimonials_name' );?></strong>
                </span>
            <?php endif ;?>

            <?php if ( ig_testimonials_get_meta( 'ig_testimonials_job' ) ) : ;?>
                <span class="job">
                    <?php echo ig_testimonials_get_meta( 'ig_testimonials_job' ); ?>
                </span>
            <?php endif ;?>

            <?php if ( ig_testimonials_get_meta( 'ig_testimonials_website' ) ) : ;?>
                <span class="website">
                <a href="<?php echo esc_url(ig_testimonials_get_meta('ig_testimonials_website')); ?>" rel="nofollow">
                    <?php esc_html_e('Website &#8594;', 'ig-testimonials'); ?>
                </a>
                </span>
            <?php endif ;?>

            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
   </div>
<?php
        echo $args['after_widget'];
    }
/**
* Back-end widget form.
**/
public function form( $instance ) {
$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
$cat = isset( $instance[ 'testimonial_cat' ]) ? esc_attr( $instance['testimonial_cat'] ) : '';
$show_image = isset( $instance[ 'show_image' ]) ? esc_attr( $instance['show_image'] ) : '';
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
        <p><input class="checkbox" type="checkbox" value="1" <?php checked( '1', $show_image ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php esc_html_e( 'Display testimonial image?', 'ig-testimonials' ); ?></label></p>
<p>
<label for="<?php echo $this->get_field_id( 'testimonial_cat' ); ?>"><?php _e( 'Show categories:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'testimonial_cat' ); ?>" name="<?php echo $this->get_field_name( 'testimonial_cat' ); ?>" type="text" value="<?php echo $cat; ?>">
</p>
<?php
}
/**
* Sanitize widget form values as they are saved.
**/
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['testimonial_cat'] = ( ! empty( $new_instance['testimonial_cat'] ) ) ? strip_tags( $new_instance['testimonial_cat'] ) : '';
$instance['show_image'] = ( ! empty( $new_instance['show_image'] ) ) ? strip_tags( $new_instance['show_image'] ) : '';

return $instance;
    }
} // Class ends here

// Register and load the widget
function ig_testimonials_load_widget() {
    register_widget( 'ig_testimonials_carousel_widget' );
}
add_action( 'widgets_init', 'ig_testimonials_load_widget' );
