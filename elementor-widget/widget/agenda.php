<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Agenda extends Widget_Base{

    public function get_name(){
        return 'agenda';
    }

    public function get_title(){
        return 'Agenda';
    }

    public function get_icon(){
        return 'eicon-person';
    }

    public function get_categories(){
        return ['ippi-elements'];
    }


    protected function register_controls(){

        //include custom controls
        require ('controls/control-agenda.php');

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
        include ('render-widget/agenda-html.php');
        echo ob_get_clean();
    }
}
