<?php 
if(!defined('ABSPATH')) exit;

class Testimonials extends \Elementor\Widget_Base {
    public function get_name() {
        return 'testimonials';
    }
    public function get_title() {
        return esc_html__('Testimonials', 'dodai-addons');
    }
    public function get_icon() {
        return 'fa fa-quote-right';
    }
    public function get_categories() {
        return ['dodai'];
    }

    protected function register_controls(){
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
                        'name' => 'question',
                        'label' => esc_html__('Question', 'test-addons'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,

                    ],
                    [
                        'name' => 'answer',
                        'label' => esc_html__('Answer', 'test-addons'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,

                    ],

                ]
            ]
        );
    }

    protected function render(){
        echo 'Testimonials widget';
    }
}