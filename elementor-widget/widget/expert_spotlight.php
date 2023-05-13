<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class ExpertSpotlight extends Widget_Base{

    public function get_name(){
        return 'experts_spotlight';
    }

    public function get_title(){
        return 'Expert Spotlight';
    }

    public function get_icon(){
        return 'eicon-video-camera';
    }

    public function get_categories(){
        return ['ippi-elements'];
    }


    protected function register_controls(){

        //include custom controls
        require ('controls/expert-spotlight.php');

        // Style Tab
        $this->style_tab();
    }

    private function style_tab() {
        //include styles
        //require ('../style_tab.php');
    }
    protected function render(){
        $settings = $this->get_settings_for_display();

        // echo "<pre>";
        // print_r($settings);

        //include html
        ob_start();
        include ('render-widget/expert-spotlight-html.php');
        echo ob_get_clean();
    }
}
