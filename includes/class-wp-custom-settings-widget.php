
<?php
// Creating the widget 
class Wp_Custom_Settings_Widget extends WP_Widget {
  
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'wpcs_widget', 
        
        // Widget name will appear in UI
        __('WPCS Widget', 'wp-custom-settings' ), 
        
        // Widget description
        array( 'description' => __( 'User details widget', 'wp-custom-settings' ), ) 
        );
    }
      
    // Creating widget front-end
      
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        // This is where you run the code and display the output
        echo __( 'Hello, My Name is ' . $instance['first_name'] . ' ' . $instance['last_name'], 'wp-custom-settings' );

        if ( ! empty( $instance[ 'sex_public' ] ) ) :
            echo __( 'Gender:  ' . $instance['sex'], 'wp-custom-settings' );  
        endif;

        echo $args['after_widget'];
    }
              
    // Widget Backend 
    public function form( $instance ) {
        $title = '';
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }

        $first_name = '';
        if ( isset( $instance[ 'first_name' ] ) ) {
            $first_name = $instance[ 'first_name' ];
        }

        $last_name = '';
        if ( isset( $instance[ 'last_name' ] ) ) {
            $last_name = $instance[ 'last_name' ];
        }

        $sex = '';
        if ( isset( $instance[ 'sex' ] ) ) {
            $sex = $instance[ 'sex' ];
        }

        $sex_public = '';
        if ( isset( $instance[ 'sex_public' ] ) ) {
            $sex_public = $instance[ 'sex_public' ];
        }
        // Widget admin form
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'first_name' ); ?>"><?php _e( 'First Name:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'first_name' ); ?>" name="<?php echo $this->get_field_name( 'first_name' ); ?>" type="text" value="<?php echo esc_attr( $first_name ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'last_name' ); ?>"><?php _e( 'Last Name:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'last_name' ); ?>" name="<?php echo $this->get_field_name( 'last_name' ); ?>" type="text" value="<?php echo esc_attr( $last_name ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'sex' ); ?>"><?php _e( 'Sex:' ); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id( 'sex' ); ?>" name="<?php echo $this->get_field_name( 'sex' ); ?>" >
            <option value="male" <?php echo ( 'male' == esc_attr( $sex ) ) ? 'checked' : ''; ?> ><?php echo __('Male', 'wp-custom-settings' ); ?></option>
            <option value="female" <?php echo ( 'female' == esc_attr( $sex ) ) ? 'checked' : ''; ?> ><?php echo __('Female', 'wp-custom-settings' ); ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'display_sex_public' ); ?>">
        <input class="widefat" id="<?php echo $this->get_field_id( 'display_sex_public' ); ?>" name="<?php echo $this->get_field_name( 'display_sex_public' ); ?>" type="checkbox" value="1" <?php echo ( '1' == $this->get_field_name( 'display_sex_public' ) ) ? 'checked' : ''; ?> /> <?php echo __('Display sex publicly?', 'wp-custom-settings' ); ?></label>
    </p>
    <?php 
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title']              = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['first_name']         = ( ! empty( $new_instance['first_name'] ) ) ? strip_tags( $new_instance['first_name'] ) : '';
        $instance['last_name']          = ( ! empty( $new_instance['last_name'] ) ) ? strip_tags( $new_instance['last_name'] ) : '';
        $instance['sex']                = ( ! empty( $new_instance['sex'] ) ) ? strip_tags( $new_instance['sex'] ) : '';
        $instance['display_sex_public'] = ( ! empty( $new_instance['display_sex_public'] ) ) ? strip_tags( $new_instance['display_sex_public'] ) : '';

        return $instance;
    }
     
}
