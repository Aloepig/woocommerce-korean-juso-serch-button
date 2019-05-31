<?php
 /**
 * Plugin Name: WooCommerce - Korean Juso Search button
 * Plugin URI: https://github.com/Aloepig/woocommerce-korean-juso-serch-button
 * Description: Korean postal code search form using "http://www.juso.go.kr" API (주소검색버튼 추가)
 * Version: 1.0.0
 * Author: aloepig (이병직)
 * Author URI: https://byonjiwa.com
 * Text Domain: woocommerce-korean-juso-search-button
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 *
 * @package WooCommerce
 * @category Postcode
 * @author aloepig (aloepig@gmail.com)
 */

defined( 'ABSPATH' ) || exit;

function wc_juso_button_scripts(){
    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'js/juso.go.kr.js', array('jquery'), '1.0.0', false ); 
}

// woocommerce : 주소검색 버튼
function jh_juso_search_button() {
    ?>
    <input type="text" id="jh_juso_search_text">
    <button type="button" id="jh_juso_search_button" onclick="getAddr();">우편번호 검색</button>
    <div id=jh_juso_list></div>
    <script>
   // jQuery("jh_juso_search_button").click(getAddr());
    function jusoSearch() {}
    </script>
    <?php
}

add_action( 'wp_enqueue_scripts', 'wc_juso_button_scripts');
add_action( 'woocommerce_after_checkout_billing_form' ,'jh_juso_search_button', 20);

//2019.5.30 테스트
// https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
//add_filter('woocommerce_billing_fields', 'custom_override_checkout_fields');
//add_filter('woocommerce_shipping_fields', 'custom_override_checkout_fields');
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    // $fields['order']['order_comments']['placeholder'] = 'My new placeholder';
    // $fields['billing']['billing_postcode']['clear'] = true;
    // $fields['order']['order_comments']['label'] = 'My new label';
    // $fields['shipping']['shipping_phone'] = array(
    //     'label'     => __('Phone', 'woocommerce'),
    // 'placeholder'   => _x('Phone', 'placeholder', 'woocommerce'),
    // 'required'  => false,
    // 'class'     => array('form-row-wide'),
    // 'clear'     => true
    // );
    return $fields;
}

add_filter('woocommerce_billing_fields', 'my_woocommerce_billing_fields'); 
function my_woocommerce_billing_fields($fields) { 
    $fields['billing_postcode']['custom_attributes'] = array('readonly'=>'readonly');
 return $fields; 
}

?>