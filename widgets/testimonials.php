<?php
if (!defined('ABSPATH')) exit;

class Testimonials extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'testimonials';
    }
    public function get_title()
    {
        return esc_html__('Testimonials', 'dodai-addons');
    }
    public function get_icon()
    {
        return 'fa fa-quote-right';
    }
    public function get_categories()
    {
        return ['dodai'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'dodai-addons'),
            ]
        );
        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'test-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'testimonail',
                        'label' => esc_html__('Testimonial', 'test-addons'),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,

                    ],
                    [
                        'name' => 'facebook',
                        'label' => esc_html__('Facebook', 'test-addons'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,

                    ],
                    [
                        'name' => 'name',
                        'label' => esc_html__('Name', 'test-addons'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,

                    ],
                    [
                        'name' => 'image',
                        'label' => esc_html__('Image', 'test-addons'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ]

                ]
            ]
        );
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $testimonials = $settings['testimonials'];
?>
        <section class="mebrik_testimonails ">
            <section id="hero_section_thumbnails_container" class="splide" aria-label="hero section">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($testimonials as $testimonial) : ?>
                            <li class="mebrik_testimonial splide__slide">

                                <div class="mebrik_testimonial_content">
                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="39" height="39" transform="matrix(1 0 0 -1 0 39)" fill="white" />
                                        <path d="M21.1241 7.01998V19.7992L28.7318 31.98H35.3137L29.4584 20.5685H35.3137V7.01998H21.1241ZM3.90002 7.01998V19.7992L11.3795 31.98H18.1324L12.1488 20.5685H18.1324V7.01998H3.90002Z" fill="#E3EBFF" />
                                    </svg>
                                    <?php echo $testimonial['testimonail']; ?>
                                </div>
                                <div class="mebrik_testimonial_info">
                                    <?php echo $testimonial['name']; ?>
                                </div>

                            </li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

        </section>
<?php
    }
}
