<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Ace Editor
 *
 */
if( ! class_exists( 'Exopite_Simple_Options_Framework_Field_ace_editor' ) ) {
    class Exopite_Simple_Options_Framework_Field_ace_editor extends Exopite_Simple_Options_Framework_Fields {

        public function __construct( $field, $value = '', $unique = '', $where = '' ) {

            parent::__construct( $field, $value, $unique, $where );

        }

        public function output() {

            $editor_id = $this->field['id'];

            $defaults  = array(
                'theme'                     => 'ace/theme/chrome',
                'mode'                      => 'ace/mode/javascript',
                'showGutter'                => true,
                'showPrintMargin'           => true,
                'enableBasicAutocompletion' => true,
                'enableSnippets'            => true,
                'enableLiveAutocompletion'  => true,
            );

            $options = ( ! empty( $this->field['options'] ) ) ? $this->field['options'] : array();
            $options = json_encode( wp_parse_args( $options, $defaults ) );

            echo $this->element_before();

            echo '<div class="exopite-sof-ace-editor-wrapper">';
            echo '<div id="exopite-sof-ace-'. $editor_id .'" class="exopite-sof-ace-editor"'. $this->element_attributes() .'></div>';
            echo '</div>';

            echo '<textarea class="exopite-sof-ace-editor-textarea hidden" name="'. $this->element_name() .'">'. $this->element_value() .'</textarea>';
            echo '<textarea class="exopite-sof-ace-editor-options hidden">'. $options .'</textarea>';

            echo $this->element_after();

        }

        public static function enqueue( $plugin_dir_url ) {

            if( ! wp_script_is( 'exopite-sof-ace-editor' ) ) {

                //https://cdnjs.com/libraries/ace/

                wp_enqueue_script( 'exopite-sof-ace-editor', '//cdnjs.cloudflare.com/ajax/libs/ace/1.2.4/ace.js', array( 'jquery', 'exopite-simple-options-framework-js' ), '1.2.4', true );

                wp_enqueue_script( 'exopite-sof-ace-editor-language_tool', '//cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ext-language_tools.js', array( 'exopite-sof-ace-editor' ), '1.2.4', true );

                wp_enqueue_script( 'exopite-simple-options-ace-js', $plugin_dir_url . 'assets/ace-loader.min.js', array( 'exopite-sof-ace-editor-language_tool' ), '20171229', true );
            }

        }

    }
}
