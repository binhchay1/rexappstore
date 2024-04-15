<?php
/**
 * Product setting price
 */
function mh_product_set_price($atts) {
	extract(shortcode_atts(array(
	), $atts));
	ob_start(); 
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
if( have_rows('mh_price_range', 'option') ): 
 $count_range = count(get_field('mh_price_range','option'));
	  $dem_range = 1;

?>

  <ul class="nav nav-center nav-size-large nav-spacing-xlarge nav-product-set-price">
   
      <?php while( have_rows('mh_price_range', 'option') ): the_row();
        $mh_price_setting_1 = get_sub_field('mh_price_setting_1');
        $mh_price_setting_2 = get_sub_field('mh_price_setting_2');
	    $mh_price_setting_3 = get_sub_field('mh_price_setting_3');
        ?>
        <li class="items-price uppercase <?php echo ($dem_range == 1?'active':''); ?>" data-price="<?php echo $mh_price_setting_2; ?>" data-toprice="<?php echo $mh_price_setting_3; ?>">
          <?php echo $mh_price_setting_1; ?>
        </li>
      <?php
	    $dem_range++;
	    
	endwhile; ?>
   
    
   
  </ul>

   
      <?php
	   $dem_range_2 = 1;
	   while( have_rows('mh_price_range', 'option') ): the_row();
	   if($dem_range_2 == 1) 
	   {
        $mh_price_setting_1 = get_sub_field('mh_price_setting_1');
        $mh_price_setting_2 = get_sub_field('mh_price_setting_2');
        $mh_price_setting_3 = get_sub_field('mh_price_setting_3');
        $product = array(
          'post_type' => 'product',
          'order' => 'asc',
			'orderby'        => 'meta_value_num',
            'meta_key'       => '_price',
          'post_status' => 'publish',
          'posts_per_page' => 8,
          'meta_query' => array(
            	array(
					'key' => '_price',
					'value' => $mh_price_setting_2,
					'type' => 'numeric', // specify it for numeric values
					'compare' => '>='
					//'compare' => '='
				),
				 array(
					'key' => '_price',
					'value' => $mh_price_setting_3,
					'type' => 'numeric', // specify it for numeric values
					'compare' => '<'
					//'compare' => '='
				)
          )
        );

        // echo '<pre>';
        // print_r( $product );
        // echo '</pre>';

        $mh_query_product = new WP_Query( $product );
        $count = $mh_query_product->post_count; ?>
       <!-- <div class="spinner">
         <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>-->

        <div class="mh-product-set-price">
          <?php if( $mh_query_product->have_posts() ) : ?>
            <div class="row large-columns-5 medium-columns-3 small-columns-1 row-small div_range_price <?php if ( $count>=5 ) : echo 'mh-carousel mh-custom-arrow slider row-slider slider-nav-simple slider-nav-outside'; endif; ?>">
              <?php while( $mh_query_product->have_posts() ) : $mh_query_product->the_post(); ?>
                <?php wc_get_template_part( 'content', 'product' );
              endwhile; ?>
				
				
            </div>
             <div id="gap-907680221" class="gap-element clearfix" style="display:block; height:auto;"><style>
#gap-907680221 {
  padding-top: 20px;
}
</style>
					
	</div><a href="<?php echo $shop_page_url ?>?orderby=price&min_price=<?php echo $mh_price_setting_2; ?><&max_price=<?php echo $mh_price_setting_3; ?>" target="_self" class="my-button mh-button-effect">
    <span>Xem thêm sản phẩm</span>
  </a>
          <?php else :
            echo '<div class="col small-12 large-12 medium-12">';
              echo '<p class="text-center mh-no-product">';
                _e( 'Hiện chưa có sản phẩm trong danh mục ...', 'flatsome' );
              echo '</p>';
            echo '</div>';
          endif; ?>
        </div>

      <?php 
	   $dem_range_2++;
	   }
	endwhile; 
   

endif; 
  $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode('mh_product_set_price', 'mh_product_set_price');
