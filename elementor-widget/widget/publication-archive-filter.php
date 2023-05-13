<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class PublicationArchiveFilter extends Widget_Base{

    public function get_name(){
        return 'publication-archive-filter';
    }

    public function get_title(){
        return 'Publication Archive Filter';
    }

    public function get_icon(){
        return 'eicon-search';
    }

    public function get_categories(){
        return ['ippi-elements'];
    }


    protected function register_controls(){

        //include custom controls
        require ('controls/control-publication-archive-filter.php');

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
        include ('render-widget/publication-archive-filter-html.php');
        echo ob_get_clean();
    }
}
