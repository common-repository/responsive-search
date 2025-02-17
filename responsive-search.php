<?php
/*
 * Plugin Name: Responsive Search Widget
 * Description:  <a href="https://wordpress.org/support/view/plugin-reviews/responsive-search?rate">Rate this plugin</a> | Responsive Search Widget is just like the default WordPress search widget, but with a search field that re-sizes in response to screen size. Once you've activated the plugin, go on over to Appearance>Widgets and drag the Responsive Search Widget into your sidebar. Voila!
 * Author: Erin McIntyre 
 * Version: 1.1.1
 * Author URI: http://www.erinmcintyre.com
*/
/* Start Adding Functions Below this Line */

// Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Responsive Search', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Similar to the default search widget, but with a search field that re-sizes in response to screen size.', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

$CERoot = get_bloginfo('wpurl');
?> 


<form role="search" method="get" class="search-form" style="padding-top:10px; padding-bottom:25px;" action="<?php echo $CERoot; ?>">
	<div class="responsive-search_wrapper" style="width: 100%;">
		<input class="responsive-search_input" placeholder="Search" value="" type="search" name="s" required="" style="width:100%;">
	</div>
</form>



<?php

}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( '', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

/* Stop Adding Functions Below this Line */
?>