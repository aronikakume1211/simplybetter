<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Location_Popup extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'location_popup';
    }

    public function get_title()
    {
        return __('simplybetter Location Up', 'dodai-addons');
    }

    public function get_icon()
    {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return ['dodai'];
    }
    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'dodai-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'popular_cities',
            [
                'label' => esc_html__('Popular Cities', 'dodai-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'city_name',
                        'label' => esc_html__('City Name', 'dodai-addons'),
                        'type' => \Elementor\Controls_Manager::TEXT,

                    ],
                    [
                        'name' => 'image',
                        'label' => esc_html__('Image', 'dodai-addons'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ]

                ]
            ]
        );
        $this->add_control(
            'other_cities',
            [
                'label' => esc_html__('Other Cities', 'dodai-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'city_name',
                        'label' => esc_html__('City Name', 'dodai-addons'),
                        'type' => \Elementor\Controls_Manager::TEXT,

                    ],

                ]
            ]
        );
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $popular_cities = $settings['popular_cities'];
        $other_cities = $settings['other_cities'];
?>
        <div class="location_popup_container_overlay <?php echo !is_user_logged_in() ? 'logged_in' : 'not_logged_in'; ?>">
            <div class="location_popup_container">
                <h3 class="select_location_title">Select Location</h3>
                <p class="provide_location">Provide your location to serve you better</p>
                <div class="cities">
                    <div class="popular_city">
                        <h4 class="popular_city_title">Popular Cities</h4>
                        <?php if (!empty($popular_cities)) : ?>
                            <ul class="popular_cities_list d-flex flex-wrap gap-40 ">
                                <?php foreach ($popular_cities as $popular_city) : ?>
                                    <li class="popular_city_list_item">
                                        <img src="<?php echo $popular_city['image']['url']; ?>" alt="<?php echo $popular_city['city_name']; ?>">
                                        <p><?php echo $popular_city['city_name']; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="other_city">
                        <h4 class="other_city_title">Other Cities</h4>
                        <?php if (!empty($other_cities)) : ?>
                            <ul class="other_cities_list d-flex flex-wrap gap-20 ">
                                <?php foreach ($other_cities as $other_city) : ?>
                                    <li class="other_city_list_item">
                                        <p><?php echo $other_city['city_name']; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php


    }
}
