<?php

/**
 * Plugin Name: Dodai Elementor Addons
 * Description: Elementor custom widgets and addons for dodai.
 * Plugin URI:  https://dodai.co/
 * Version:     1.0.0
 * Author:      Mebratu Kumera
 * Author URI:  https://dodai.com/
 * Text Domain: dodai-addons
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if (!defined('ABSPATH')) exit;

define('MEBRIK_PLUGIN_PATH', plugin_dir_path(__FILE__));

require_once MEBRIK_PLUGIN_PATH . 'inc/api.php';

add_action('init', 'call_api');

function call_api()
{
    new Mebrik_Api();
}

// add_action('rest_api_init',  [$api_class, 'user_registration_api']);


add_action('wp_enqueue_scripts', 'test_plugin_scripts');

function test_plugin_scripts()
{

    // Dequeue default jquery
    wp_dequeue_script( 'jquery-core' );
    wp_dequeue_script( 'jquery-migrate' );
    wp_dequeue_script( 'jquery-blockui' );

    // Registering styles
    wp_register_style('index-style', plugins_url('assets/index.css', __FILE__));
    // wp_register_style('splidecss', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), null);

    // Registering scripts
    wp_register_script('jquery-custom-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), null, true);
    wp_register_script('splidejs', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array('jquery-custom-script'), null, true);
    wp_register_script('testimonail-script', plugins_url('assets/js/testimonial.js', __FILE__), array('jquery-custom-script'), null, true);
    wp_register_script('location-script', plugins_url('assets/js/location.js', __FILE__), array('jquery-custom-script'), null, true);
    wp_register_script('countdown-script', plugins_url('assets/js/countdown.js', __FILE__), array('jquery-custom-script'), null, true);
    wp_register_script('signin-signout-script', plugins_url('assets/js/signin-signout.js', __FILE__), array('jquery-custom-script'), null, true);

    // Enqueuing styles
    wp_enqueue_style('index-style');
    // wp_enqueue_style('splidecss');

    // Enqueuing scripts
    if (is_front_page()) {
        wp_enqueue_script('jquery-custom-script');
        wp_enqueue_script('splidejs');
        wp_enqueue_script('testimonail-script');
    }
    wp_enqueue_script('location-script');
    wp_enqueue_script('countdown-script');
    wp_enqueue_script('signin-signout-script');

    // Function to output Splide CSS in the footer
    function enqueue_splide_css_in_footer()
    {
        if (is_front_page()) {
?>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" type="text/css" media="all">
<?php
        }
    }
    add_action('wp_footer', 'enqueue_splide_css_in_footer');
}




function dodai_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'dodai',
        [
            'title' => esc_html__('Dodai', 'dodai-addons'),
            'icon' => 'fa fa-plug'
        ]
    );
}

add_action('elementor/elements/categories_registered', 'dodai_widget_categories');

/**
 * Register Widgets.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_essential_custom_widgets($widgets_manager)
{
    require_once(__DIR__ . '/widgets/testimonials.php');
    require_once(__DIR__ . '/widgets/custom-product-list.php');
    require_once(__DIR__ . '/widgets/signin-signout.php');
    require_once(__DIR__ . '/widgets/location.php');
    require_once(__DIR__ . '/widgets/country.php');
    require_once(__DIR__ . '/widgets/countdown.php');

    $widgets_manager->register(new Testimonials());
    $widgets_manager->register(new Custom_Products_List());
    $widgets_manager->register(new Signin_Signout());
    $widgets_manager->register(new Location_Popup());
    $widgets_manager->register(new Mebrik_Country());
    $widgets_manager->register(new Mebrik_Countdown());
}

add_action('elementor/widgets/register', 'register_essential_custom_widgets');
