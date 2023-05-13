<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class CTA extends Widget_Base{

    public function get_name(){
        return 'ippi-call-to-action';
    }

    public function get_title(){
        return 'Ippi Call To Action';
    }

    public function get_icon(){
        return 'eicon-call-to-action';
    }

    public function get_categories(){
        return ['ippi-elements'];
    }


    protected function register_controls(){

        //include custom controls
        require ('controls/control-cta.php');

        // Style Tab
        $this->style_tab();
    }

    private function style_tab() {
        //include styles
        //require ('../style_tab.php');
    }
    protected function render(){
        $settings = $this->get_settings_for_display();

        //include html
        ob_start();
        include ('render-widget/cta-html.php');
        echo ob_get_clean();
    }
}
