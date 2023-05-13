<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Core\Schemes;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Image_Box extends Widget_Base{

    public function get_name(){
        return 'ippi-image-box';
    }

    public function get_title(){
        return 'IPPI Image Box';
    }

    public function get_icon(){
        return 'eicon-image-box';
    }

    public function get_categories(){
        return ['ippi-elements'];
    }


    protected function register_controls(){

        //include custom controls
        require ('controls/control-image-box.php');

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
        include ('render-widget/image-box-html.php');
        echo ob_get_clean();
    }
}
