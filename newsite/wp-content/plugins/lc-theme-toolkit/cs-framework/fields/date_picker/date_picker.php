<?php 
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Datepicker
 *
 * @since 1.0
 * @version 1.0
 *
 */
class CSFramework_Option_date_picker extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output(){

    echo $this->element_before();
    echo '<input class="datepicker" type="text" name="'. $this->element_name() .'" value="'. $this->element_value() .'"'. $this->element_class() . $this->element_attributes() .'/>';
    echo $this->element_after();

  }

}


add_action( 'admin_enqueue_scripts', 'enqueue_date_picker' );
function enqueue_date_picker(){
  wp_enqueue_style('jquery-ui-css', CS_URI .'/fields/date_picker/jquery-ui.min.css');
  wp_enqueue_script(
      'field-date-js', 
      CS_URI .'/fields/date_picker/field_date.js', 
      array('jquery-ui-datepicker'),
      time(),
      true
  );
}
