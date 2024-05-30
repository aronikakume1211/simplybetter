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


add_action('wp_enqueue_scripts', 'test_plugin_scripts');


function test_plugin_scripts()
{
    wp_enqueue_style('index-style',  plugins_url('assets/index.css', __FILE__));
    // wp_enqueue_script('shutter-script',  plugins_url('assets/js/shutter.js', __FILE__));
    // wp_enqueue_script('faq-script',  plugins_url('assets/js/faq.js', __FILE__));
    // wp_enqueue_script('frontpage-script',  plugins_url('assets/js/frontpage.js', __FILE__));
    wp_enqueue_script('splidejs', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js');
    wp_enqueue_style('splidecss', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css');
    wp_enqueue_style('fontawesome',  '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    ');
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
    require_once(__DIR__ . '/widgets/product-list.php');

    $widgets_manager->register(new Testimonials());
    $widgets_manager->register(new Products_List());
}

add_action('elementor/widgets/register', 'register_essential_custom_widgets');