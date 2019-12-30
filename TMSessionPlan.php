<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists('TMSessionPlan')):
  class TMSessionPlan extends TMBasePost {
    protected static $post_type = 'tm_sessionplan';

    protected static $labels = Array(
      'singular_name'       => 'Session Plan',
      'slug'                => 'sessionplans'
    );

    protected static $tmargs = Array (
      'create_metadatabox'  => false
    );

    protected static $args = Array (
      'supports'            => array( 'title', 'editor', 'author', 'revisions', 'thumbnail', 'revisions'),
    );

    protected static $meta_keys = Array(
      'agegroup' => Array(
        'type'      => 'meta_attrib_number',
        'meta_key'  => 'agegroup',
        'label'     => 'Age-group'
      ),
      'objective' => Array(
        'type'      => 'meta_attrib_text',
        'meta_key'  => 'objective',
        'label'     => 'Objective',
        'settings'  => Array (
          'editor_height' => 50
        )
      ),
      'equipment' => Array(
        'type'      => 'meta_attrib_text',
        'meta_key'  => 'equipment',
        'label'     => 'Equipment required',
        'settings'  => Array (
          'editor_height' => 50
        )
      ),
      'method' => Array(
        'type'      => 'meta_attrib_text',
        'meta_key'  => 'method',
        'label'     => 'Method',
        'settings'  => Array (
          'editor_height' => 300
        )
      ),
      'progressions' => Array(
        'type'      => 'meta_attrib_text',
        'meta_key'  => 'progressions',
        'label'     => 'Progressions',
        'settings'  => Array (
          'editor_height' => 150
        )
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
      TMSessionPlan::inner_custom_field_nonce('plan');
      TMSessionPlan::inner_custom_field($post,'objective');
      TMSessionPlan::inner_custom_field($post,'equipment');
      TMSessionPlan::inner_custom_field($post,'method');
      TMSessionPlan::inner_custom_field($post,'progressions');
    }

  }
  TMSessionPlan::init();
endif;
?>
