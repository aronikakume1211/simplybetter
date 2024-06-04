<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Mebrik_Country extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'country';
    }

    public function get_title()
    {
        return __('simplybetter country', 'dodai-addons');
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
    }

    protected function render()
    {
?>
        <div id="selected_country" style="cursor: pointer; display: flex; align-items: center;">
            <span id="selected_country_name">Bangalore</span><svg width="10" height="10" viewBox="0 0 6 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 4L0.834937 0.25L5.16506 0.25L3 4Z" fill="#233332"></path>
            </svg>
        </div>
<?php

    }
}
