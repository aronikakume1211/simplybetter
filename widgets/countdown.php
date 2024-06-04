<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Mebrik_Countdown extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'simplybetter_countdown';
    }

    public function get_title()
    {
        return __('simplybetter countdown', 'dodai-addons');
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
        <div id="mebrik_timer">00:00:00</div>
<?php

    }
}
