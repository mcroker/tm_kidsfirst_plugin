<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists('TMSessionPlan')):
  class TMSessionPlan extends TMBasePost {
    protected static $post_type = 'tm_sessionplan';

    protected static $labels = Array(
      'singular_name'       => 'Session Plan',
      'slug'                => 'sessionplans'
    );

    protected static $args = Array (
      'supports'            => array( 'title', 'editor', 'author', 'revisions', 'thumbnail', 'revisions'),
    );

    protected static $meta_keys = Array(
      'agegroup' => Array(
        'type'      => 'meta_attrib',
        'meta_key'  => 'agegroup',
        'label'     => 'Age-group'
      ),
      'objective' => Array(
        'type'      => 'meta_attrib_text',
        'meta_key'  => 'objective',
        'label'     => 'Objective',
        'display'   => false
      ),
      'equipment' => Array(
        'type'      => 'meta_attrib_text',
        'meta_key'  => 'equipment',
        'label'     => 'Equipment required',
        'display'   => false
        )
      );

      function __construct($sessionid = 0) {
        parent::__construct($sessionid);
      }

      public static function init() {
        parent::init();
        if ( is_admin() ) {
          $classname = get_called_class();
          add_action( 'add_meta_boxes',  'TMSessionPlan::create_plan_metadatabox' );
        }
      }

      public static function create_plan_metadatabox() {
        if ( is_admin() ) {
          add_meta_box(
            TMSessionPlan::$post_type,
            'Session Plan',
            'TMSessionPlan::inner_plan_custom_box',
            TMSessionPlan::$post_type,
            'normal',
            'default'
          );
        }
      }

      public static function inner_plan_custom_box($post) {
        TMSessionPlan::inner_custom_field_text('objectives', 'Session Objectives', '');
        TMSessionPlan::inner_custom_field_text('equipment', 'Equipment Required', '');
      }

    }
    TMSessionPlan::init();
  endif;
  ?>
