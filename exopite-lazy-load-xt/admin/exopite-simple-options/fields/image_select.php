<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Image Select
 *
 */
if( ! class_exists( 'Exopite_Simple_Options_Framework_Field_image_select' ) ) {

    class Exopite_Simple_Options_Framework_Field_image_select extends Exopite_Simple_Options_Framework_Fields {

        public function __construct( $field, $value = '', $unique = '', $where = '' ) {
            parent::__construct( $field, $value, $unique, $where );
        }

        public function output() {

            $input_type  = ( ! empty( $this->field['radio'] ) ) ? 'radio' : 'checkbox';
            $input_attr  = ( $input_type == 'checkbox' ) ? '[]' : '';

            echo $this->element_before();
            echo ( empty( $input_attr ) ) ? '<div class="exopite-sof-field-image-selector">' : '';

            if( isset( $this->field['options'] ) ) {
                $options  = $this->field['options'];
                foreach ( $options as $key => $value ) {
                    echo '<label><input type="'. $input_type .'" name="'. $this->element_name( $input_attr ) .'" value="'. $key .'"'. $this->element_class() . $this->  element_attributes( $key ) . $this->checked( $this->element_value(), $key ) .'/>';
                    echo ( ! empty( $this->field['text_select'] ) ) ? '<span class="exopite-sof-'. sanitize_title( $value ) .'">'. $value .'</span>' : '<img src="'. $value .'"   alt="'. $key .'" />';
                    echo '</label>';
                }
            }

            echo ( empty( $input_attr ) ) ? '</div>' : '';
            echo $this->element_after();

        }

    }

}
