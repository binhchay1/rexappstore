<?php
// Add custom Theme Functions here
function themeslug_enqueue_style() {
    wp_enqueue_script( 'mobile-detect', trailingslashit( get_stylesheet_directory_uri() ) . 'js/mobile-detect.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'pizza-js', trailingslashit( get_stylesheet_directory_uri() ) . 'js/pizza.js', array('jquery','mobile-detect'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );

add_filter( 'body_class', 'devvn_mobile_class' );
function devvn_mobile_class( $classes ) {
    if(wp_is_mobile()){
        $classes[] = 'devvn_mobile';
    }else{
        $classes[] ="devvn_desktop";
    }
    return $classes;
}

function find_valid_variations() {
    global $product;

    $variations = $product->get_available_variations();
    $attributes = $product->get_attributes();
    $new_variants = array();

    // Loop through all variations
    foreach( $variations as $variation ) {
        // Peruse the attributes.

        // 1. If both are explicitly set, this is a valid variation
        // 2. If one is not set, that means any, and we must 'create' the rest.

        $valid = true; // so far
        foreach( $attributes as $slug => $args ) {
            if( array_key_exists("attribute_$slug", $variation['attributes']) && !empty($variation['attributes']["attribute_$slug"]) ) {
                // Exists

            } else {
                // Not exists, create
                $valid = false; // it contains 'anys'
                // loop through all options for the 'ANY' attribute, and add each
                foreach( explode( '|', $attributes[$slug]['value']) as $attribute ) {
                    $attribute = trim( $attribute );
                    $new_variant = $variation;
                    $new_variant['attributes']["attribute_$slug"] = $attribute;
                    $new_variants[] = $new_variant;
                }

            }
        }

        // This contains ALL set attributes, and is itself a 'valid' variation.
        if( $valid )
            $new_variants[] = $variation;

    }

    return $new_variants;
}
function list_price_variable(){
    global $product, $post;

    $variations = find_valid_variations();

    // Check if the special 'price_grid' meta is set, if it is, load the default template:
    if ( get_post_meta($post->ID, 'price_grid', true) ) {
        // Enqueue variation scripts
        wp_enqueue_script( 'wc-add-to-cart-variation' );

        // Load the template
        wc_get_template( 'single-product/add-to-cart/variable.php', array(
            'available_variations' => $product->get_available_variations(),
            'attributes' => $product->get_variation_attributes(),
            'selected_attributes' => $product->get_variation_default_attributes()
        ) );
        return;
    }
    echo '<ul class="list_price_pizza">';
    foreach ($variations as $key => $value) {
        if( !$value['variation_is_visible'] ) continue;
        echo '<li>'.$value['price_html'].'</li>';
    }
    echo '</ul>';
}
function wc_wc20_variation_price_format( $price, $product ) {
    if(!is_admin()) {
        $price = list_price_variable();
    }
    return $price;
}
//add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

add_action('flatsome_product_box_after','devvn_woocommerce_after_shop_loop_item');
function devvn_woocommerce_after_shop_loop_item(){
    global $product, $post;
    if( $product->is_type( 'variable' ) ) {
        $variations = find_valid_variations();
        echo '<ul class="list_price_pizza list_price_pizza_text list_price_pizza_mobile">';
        foreach ($variations as $key => $value) {
            if (!$value['variation_is_visible']) continue;
            echo '<li>';
            foreach ($value['attributes'] as $key => $val) {
                $val = str_replace(array('-', '_'), ' ', $val);
                $category_slug = str_replace('attribute_', '', $key);
                $category = get_term_by('slug', ucwords($val), $category_slug);
                $categoryName = $category->name . '&nbsp;';
                printf('<span class="attr attr-%s"><a href="tel:0868180369" title="Gọi đặt hàng">%s</a></span>', $key, $categoryName);
            }
            echo '</li>';
        }
        echo '</ul>';
        echo '<ul class="list_price_pizza list_price_pizza_text list_price_pizza_desktop">';
        foreach ($variations as $key => $value) {
            if (!$value['variation_is_visible']) continue;
            echo '<li>';
            foreach ($value['attributes'] as $key => $val) {
                $val = str_replace(array('-', '_'), ' ', $val);
                $category_slug = str_replace('attribute_', '', $key);
                $category = get_term_by('slug', ucwords($val), $category_slug);
                $categoryName = $category->name . '&nbsp;';
                $link = '?add-to-cart='.$product->get_id().'&variation_id='.$value['variation_id'].'&'.$key.'='.$val;
                printf('<span class="attr attr-%s"><a href="%s" title="Thêm vào giỏ hàng">%s</a></span>', $key, $link, $categoryName);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}