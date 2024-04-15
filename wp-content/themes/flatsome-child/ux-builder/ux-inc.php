<?php
function mh_ux_builder(){
 

  add_ux_builder_shortcode('mh_product_set_price', array(
    'name'      => __('Ưu đãi theo mức giá'),
    'category'  => __('MT Builder'),
    'priority'  => 1,
    'options' => array(
    ),
  ));

}
add_action('ux_builder_setup', 'mh_ux_builder');